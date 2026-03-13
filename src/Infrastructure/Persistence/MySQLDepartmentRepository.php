<?php
declare(strict_types=1);

namespace epiGuard\Infrastructure\Persistence;

use epiGuard\Domain\Entity\Department;
use epiGuard\Domain\Repository\DepartmentRepositoryInterface;
use epiGuard\Infrastructure\Database\Connection;
use DateTimeImmutable;

class MySQLDepartmentRepository implements DepartmentRepositoryInterface
{
    private \mysqli $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function findById(int $id): ?Department
    {
        $stmt = $this->db->prepare("SELECT id, nome, sigla, status, epis_json, criado_em, atualizado_em FROM setores WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $this->hydrate($row);
        }

        return null;
    }

    public function findByCode(string $code): ?Department
    {
        $stmt = $this->db->prepare("SELECT id, nome, sigla, status, epis_json, criado_em, atualizado_em FROM setores WHERE sigla = ?");
        $stmt->bind_param('s', $code);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $this->hydrate($row);
        }

        return null;
    }

    public function findByName(string $name): ?Department
    {
        $stmt = $this->db->prepare("SELECT id, nome, sigla, status, epis_json, criado_em, atualizado_em FROM setores WHERE nome = ?");
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $this->hydrate($row);
        }

        return null;
    }

    /** @return Department[] */
    public function findAll(): array
    {
        $result = $this->db->query("SELECT id, nome, sigla, status, criado_em, atualizado_em FROM setores ORDER BY nome ASC");
        $departments = [];

        while ($row = $result->fetch_assoc()) {
            $departments[] = $this->hydrate($row);
        }

        return $departments;
    }

    /**
     * Retorna array associativo com dados do setor e contagem de funcionários
     */
    public function findAllWithStats(): array
    {
        $sql = "SELECT s.id, s.nome, s.sigla, s.status, s.epis_json, s.criado_em, s.atualizado_em, 
                       (SELECT COUNT(*) FROM funcionarios WHERE setor_id = s.id) as total_funcionarios
                FROM setores s 
                ORDER BY s.nome ASC";
        $result = $this->db->query($sql);
        $data = [];

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function save(Department $department): void
    {
        $stmt = $this->db->prepare("INSERT INTO setores (nome, sigla, epis_json) VALUES (?, ?, ?)");
        $nome = $department->getName();
        $sigla = $department->getCode();
        $episJson = json_encode($department->getEpis());
        $stmt->bind_param('sss', $nome, $sigla, $episJson);
        $stmt->execute();

        $department->setId($this->db->insert_id);
    }

    public function update(Department $department): void
    {
        $stmt = $this->db->prepare("UPDATE setores SET nome = ?, sigla = ?, epis_json = ? WHERE id = ?");
        $nome = $department->getName();
        $sigla = $department->getCode();
        $episJson = json_encode($department->getEpis());
        $id = $department->getId();
        $stmt->bind_param('sssi', $nome, $sigla, $episJson, $id);
        $stmt->execute();
    }

    public function delete(Department $department): void
    {
        $stmt = $this->db->prepare("DELETE FROM setores WHERE id = ?");
        $id = $department->getId();
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    private function hydrate(array $row): Department
    {
        $episList = [];
        if (!empty($row['epis_json'])) {
            $episList = json_decode($row['epis_json'], true) ?: [];
        }

        return new Department(
            name: $row['nome'],
            code: $row['sigla'],
            epis: $episList,
            id: (int)$row['id'],
            createdAt: new \DateTimeImmutable($row['criado_em']),
            updatedAt: $row['atualizado_em'] ? new \DateTimeImmutable($row['atualizado_em']) : null
        );
    }
}
