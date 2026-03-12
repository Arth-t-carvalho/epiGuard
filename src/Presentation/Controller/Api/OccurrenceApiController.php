<?php

namespace epiGuard\Presentation\Controller\Api;

use App\Infrastructure\Persistence\MySQLOccurrenceRepository;
use App\Infrastructure\Persistence\MySQLEmployeeRepository;
use App\Infrastructure\Persistence\MySQLDepartmentRepository;
use App\Infrastructure\Persistence\MySQLUserRepository;
use App\Infrastructure\Persistence\MySQLEpiRepository;
use epiGuard\Infrastructure\Database\Connection;

class OccurrenceApiController
{
    private MySQLOccurrenceRepository $occurrenceRepo;
    private MySQLDepartmentRepository $departmentRepo;

    public function __construct()
    {
        $db = Connection::getInstance();
        $deptRepo = new MySQLDepartmentRepository();
        $employeeRepo = new MySQLEmployeeRepository($deptRepo);
        $userRepo = new MySQLUserRepository();
        $epiRepo = new MySQLEpiRepository();
        $this->occurrenceRepo = new MySQLOccurrenceRepository($employeeRepo, $userRepo, $epiRepo);
        $this->departmentRepo = $deptRepo;
    }
    public function calendar()
    {
        header('Content-Type: application/json');
        
        $month = (int) ($_GET['month'] ?? date('n'));
        $year = (int) ($_GET['year'] ?? date('Y'));
        $sectorId = isset($_GET['sector_id']) && $_GET['sector_id'] !== 'all' ? (int)$_GET['sector_id'] : null;

        // Visão Empresarial: Filtro de Setor Dinâmico
        $db = Connection::getInstance();
        $query = "
            SELECT 
                o.data_hora as full_date, 
                s.nome AS name, 
                e.nome AS `desc`, 
                DATE_FORMAT(o.data_hora, '%H:%i') AS time,
                o.funcionario_id
            FROM ocorrencias o
            JOIN funcionarios f ON o.funcionario_id = f.id
            JOIN setores s ON f.setor_id = s.id
            JOIN ocorrencia_epis oe ON o.id = oe.ocorrencia_id
            JOIN epis e ON oe.epi_id = e.id
            WHERE MONTH(o.data_hora) = ? AND YEAR(o.data_hora) = ?
        ";

        if ($sectorId) {
            $query .= " AND s.id = ?";
        }

        $query .= " ORDER BY o.data_hora ASC";

        $stmt = $db->prepare($query);
        if ($sectorId) {
            $stmt->bind_param('iii', $month, $year, $sectorId);
        } else {
            $stmt->bind_param('ii', $month, $year);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        echo json_encode($data);
    }

    public function details()
    {
        header('Content-Type: application/json');
        
        $month = (int) ($_GET['month'] ?? date('n'));
        $year = (int) ($_GET['year'] ?? date('Y'));
        $sectorId = isset($_GET['sector_id']) && $_GET['sector_id'] !== 'all' ? (int)$_GET['sector_id'] : null;
        $epiName = $_GET['epi'] ?? '';

        $db = Connection::getInstance();
        $query = "
            SELECT 
                o.id AS ocorrencia_id, 
                DATE_FORMAT(o.data_hora, '%d/%m/%Y') AS data, 
                f.nome AS aluno, 
                f.id AS aluno_id, 
                s.nome AS curso,
                e.nome AS epis, 
                DATE_FORMAT(o.data_hora, '%H:%i') AS hora,
                'Pendente' AS status_formatado
            FROM ocorrencias o
            JOIN funcionarios f ON o.funcionario_id = f.id
            JOIN setores s ON f.setor_id = s.id
            JOIN ocorrencia_epis oe ON o.id = oe.ocorrencia_id
            JOIN epis e ON oe.epi_id = e.id
            WHERE MONTH(o.data_hora) = ? AND YEAR(o.data_hora) = ?
        ";

        if ($sectorId) {
            $query .= " AND s.id = ?";
        }
        if (!empty($epiName)) {
            $query .= " AND e.nome = ?";
        }

        $query .= " ORDER BY o.data_hora DESC";

        $stmt = $db->prepare($query);
        
        if ($sectorId && !empty($epiName)) {
            $stmt->bind_param('iiis', $month, $year, $sectorId, $epiName);
        } elseif ($sectorId) {
            $stmt->bind_param('iii', $month, $year, $sectorId);
        } elseif (!empty($epiName)) {
            $stmt->bind_param('iis', $month, $year, $epiName);
        } else {
            $stmt->bind_param('ii', $month, $year);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        echo json_encode($data);
    }
}
