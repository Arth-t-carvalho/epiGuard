<?php

namespace epiGuard\Presentation\Controller\Api;

use App\Application\Service\DashboardService;
use App\Infrastructure\Persistence\MySQLOccurrenceRepository;
use App\Infrastructure\Persistence\MySQLEmployeeRepository;
use App\Infrastructure\Persistence\MySQLDepartmentRepository;
use App\Infrastructure\Persistence\MySQLUserRepository;
use App\Infrastructure\Persistence\MySQLEpiRepository;
use App\Application\Validator\OccurrenceValidator;

class ChartApiController
{
    private DashboardService $dashboardService;

    public function __construct()
    {
        // Injeção de dependências manual para o contexto desse projeto PHP puro
        $deptRepo = new MySQLDepartmentRepository();
        $employeeRepo = new MySQLEmployeeRepository($deptRepo);
        $userRepo = new MySQLUserRepository();
        $epiRepo = new MySQLEpiRepository();
        $occurrenceRepo = new MySQLOccurrenceRepository($employeeRepo, $userRepo, $epiRepo);
        
        $this->dashboardService = new DashboardService($employeeRepo, $occurrenceRepo);
    }

    public function index()
    {
        header('Content-Type: application/json');
        
        $sectorId = isset($_GET['sector_id']) && $_GET['sector_id'] !== 'all' ? (int)$_GET['sector_id'] : null;
        $data = $this->dashboardService->getChartData($sectorId);

        echo json_encode($data);
    }
}
