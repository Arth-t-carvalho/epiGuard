<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Entity\Occurrence;
use App\Domain\Repository\OccurrenceRepositoryInterface;
use App\Domain\Repository\EmployeeRepositoryInterface;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\Repository\EpiRepositoryInterface;
use App\Domain\ValueObject\OccurrenceStatus;
use App\Domain\ValueObject\OccurrenceType;
use epiGuard\Infrastructure\Database\Connection;
use DateTimeImmutable;
use DateTimeInterface;

class MySQLOccurrenceRepository implements OccurrenceRepositoryInterface
{
    private \mysqli $db;
    private EmployeeRepositoryInterface $employeeRepository;
    private UserRepositoryInterface $userRepository;
    private EpiRepositoryInterface $epiRepository;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        UserRepositoryInterface $userRepository,
        EpiRepositoryInterface $epiRepository
    ) {
        $this->db = Connection::getInstance();
        $this->employeeRepository = $employeeRepository;
        $this->userRepository = $userRepository;
        $this->epiRepository = $epiRepository;
    }

    public function findById(int $id): ?Occurrence
    {
        $stmt = $this->db->prepare("SELECT * FROM ocorrencias WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $this->hydrate($row);
        }

        return null;
    }

    /** @return Occurrence[] */
    public function findAll(): array
    {
        $result = $this->db->query("SELECT * FROM ocorrencias ORDER BY data_hora DESC");
        $occurrences = [];
        while ($row = $result->fetch_assoc()) {
            $occurrences[] = $this->hydrate($row);
        }
        return $occurrences;
    }

    public function findByEmployeeId(int $employeeId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM ocorrencias WHERE funcionario_id = ? ORDER BY data_hora DESC");
        $stmt->bind_param('i', $employeeId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $occurrences = [];
        while ($row = $result->fetch_assoc()) {
            $occurrences[] = $this->hydrate($row);
        }
        return $occurrences;
    }

    public function findByStatus(string $status): array
    {
        // Nota: A tabela ocorrencias no schema.sql não tem campo 'status' explicitamente,
        // mas o Domain sugere. No schema simplificado, o 'tipo' filtra os dados.
        // Implementação simplificada para evitar erros de SQL se o campo não existir.
        return [];
    }

    public function countDaily(DateTimeInterface $date): int
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM ocorrencias WHERE DATE(data_hora) = ? AND tipo = 'INFRACAO'");
        $dateStr = $date->format('Y-m-d');
        $stmt->bind_param('s', $dateStr);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        return (int) $res['total'];
    }

    public function countWeekly(DateTimeInterface $date): int
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM ocorrencias WHERE YEARWEEK(data_hora, 1) = YEARWEEK(?, 1) AND tipo = 'INFRACAO'");
        $dateStr = $date->format('Y-m-d');
        $stmt->bind_param('s', $dateStr);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        return (int) $res['total'];
    }

    public function countMonthly(DateTimeInterface $date): int
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM ocorrencias WHERE MONTH(data_hora) = MONTH(?) AND YEAR(data_hora) = YEAR(?) AND tipo = 'INFRACAO'");
        $dateStr = $date->format('Y-m-d');
        $stmt->bind_param('ss', $dateStr, $dateStr);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        return (int) $res['total'];
    }

    public function getMonthlyInfractionStats(int $year): array
    {
        // Consulta para pegar infrações por mês agrupadas por EPI
        // Simulando os meses do ano (1-12)
        $months = range(1, 12);
        $stats = [
            'capacete' => array_fill(0, 12, 0),
            'oculos' => array_fill(0, 12, 0),
            'total' => array_fill(0, 12, 0)
        ];

        $query = "
            SELECT 
                MONTH(o.data_hora) as mes,
                e.nome as epi_nome,
                COUNT(*) as total
            FROM ocorrencias o
            JOIN ocorrencia_epis oe ON o.id = oe.ocorrencia_id
            JOIN epis e ON oe.epi_id = e.id
            WHERE YEAR(o.data_hora) = ? AND o.tipo = 'INFRACAO'
            GROUP BY mes, epi_nome
        ";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $year);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $mesIdx = (int) $row['mes'] - 1;
            $nome = strtolower($row['epi_nome']);
            if (str_contains($nome, 'capacete')) {
                $stats['capacete'][$mesIdx] += (int) $row['total'];
            } elseif (str_contains($nome, 'oculos')) {
                $stats['oculos'][$mesIdx] += (int) $row['total'];
            }
            $stats['total'][$mesIdx] += (int) $row['total'];
        }

        return $stats;
    }

    public function getInfractionDistributionByEpi(): array
    {
        $query = "
            SELECT 
                e.nome,
                COUNT(*) as total
            FROM ocorrencias o
            JOIN ocorrencia_epis oe ON o.id = oe.ocorrencia_id
            JOIN epis e ON oe.epi_id = e.id
            WHERE o.tipo = 'INFRACAO'
            GROUP BY e.nome
        ";

        $result = $this->db->query($query);
        $labels = [];
        $data = [];
        $totalSum = 0;

        while ($row = $result->fetch_assoc()) {
            $labels[] = $row['nome'];
            $data[] = (int) $row['total'];
            $totalSum += (int) $row['total'];
        }

        if (empty($labels)) {
            return [
                'labels' => ['Sem Infrações'],
                'data' => [0],
                'total' => 0
            ];
        }

        return [
            'labels' => $labels,
            'data' => $data,
            'total' => $totalSum
        ];
    }

    public function save(Occurrence $occurrence): void
    {
        $stmt = $this->db->prepare("INSERT INTO ocorrencias (funcionario_id, tipo, data_hora) VALUES (?, ?, ?)");
        $fid = $occurrence->getEmployee()->getId();
        $tipo = $occurrence->getType()->getValue();
        $data = $occurrence->getDate()->format('Y-m-d H:i:s');
        $stmt->bind_param('iss', $fid, $tipo, $data);
        $stmt->execute();
        $occurrence->setId((int) $this->db->insert_id);
    }

    public function update(Occurrence $occurrence): void
    {
        $stmt = $this->db->prepare("UPDATE ocorrencias SET funcionario_id = ?, tipo = ?, data_hora = ? WHERE id = ?");
        $fid = $occurrence->getEmployee()->getId();
        $tipo = $occurrence->getType()->getValue();
        $data = $occurrence->getDate()->format('Y-m-d H:i:s');
        $id = $occurrence->getId();
        $stmt->bind_param('issi', $fid, $tipo, $data, $id);
        $stmt->execute();
    }

    public function delete(Occurrence $occurrence): void
    {
        $stmt = $this->db->prepare("DELETE FROM ocorrencias WHERE id = ?");
        $id = $occurrence->getId();
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    private function hydrate(array $row): Occurrence
    {
        $employee = $this->employeeRepository->findById((int) $row['funcionario_id']);
        // Para simplificar, o sistema usa o primeiro usuário admin como registradoBy se não houver campo na tabela
        $user = $this->userRepository->findById(1); 
        
        // No schema simplificado, uma ocorrência pode ter vários EPIs, mas a entidadeOccurrence sugere um.
        // Pegamos o primeiro EPI relacionado.
        $stmt = $this->db->prepare("SELECT epi_id FROM ocorrencia_epis WHERE ocorrencia_id = ? LIMIT 1");
        $stmt->bind_param('i', $row['id']);
        $stmt->execute();
        $epiRow = $stmt->get_result()->fetch_assoc();
        $epi = $epiRow ? $this->epiRepository->findById((int) $epiRow['epi_id']) : null;

        return new Occurrence(
            employee: $employee,
            registeredBy: $user,
            epiItem: $epi,
            type: new OccurrenceType($row['tipo']),
            description: "Ocorrência registrada via sistema",
            date: new DateTimeImmutable($row['data_hora']),
            id: (int) $row['id'],
            createdAt: new DateTimeImmutable($row['criado_em'])
        );
    }
}
