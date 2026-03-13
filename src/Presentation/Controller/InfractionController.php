<?php

namespace epiGuard\Presentation\Controller;

use epiGuard\Infrastructure\Persistence\MySQLOccurrenceRepository;
use epiGuard\Infrastructure\Persistence\MySQLEmployeeRepository;
use epiGuard\Infrastructure\Persistence\MySQLUserRepository;
use epiGuard\Infrastructure\Persistence\MySQLEpiRepository;
use epiGuard\Infrastructure\Persistence\MySQLDepartmentRepository;

class InfractionController
{
    private MySQLOccurrenceRepository $occurrenceRepository;

    public function __construct()
    {
        $deptRepo = new MySQLDepartmentRepository();
        $employeeRepo = new MySQLEmployeeRepository($deptRepo);
        $userRepo = new MySQLUserRepository();
        $epiRepo = new MySQLEpiRepository();
        $this->occurrenceRepository = new MySQLOccurrenceRepository($employeeRepo, $userRepo, $epiRepo);
    }

    public function index()
    {
        $filters = [
            'search' => $_GET['search'] ?? '',
            'periodo' => $_GET['periodo'] ?? 'todos',
            'status' => $_GET['status'] ?? 'todos',
            'epi' => $_GET['epi'] ?? 'todos'
        ];

        $infractions = $this->occurrenceRepository->findInfractions($filters);
        
        require_once __DIR__ . '/../View/infractions/index.php';
    }
}
