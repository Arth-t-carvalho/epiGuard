<?php

namespace epiGuard\Presentation\Controller;

class ManagementController
{
    public function departments()
    {
<<<<<<< HEAD
        $repo = new \epiGuard\Infrastructure\Persistence\MySQLDepartmentRepository();
        $setores = $repo->findAllWithStats();
=======
        $filters = [
            'status' => $_GET['status'] ?? 'todos',
            'risk' => $_GET['risk'] ?? 'todos'
        ];
        
        $repo = new \epiGuard\Infrastructure\Persistence\MySQLDepartmentRepository();
        $setores = $repo->findAllWithStats($filters);
>>>>>>> 5399806b2ad2a0f0a03798f8626547fceabfaeb9
        require_once __DIR__ . '/../View/management/departments.php';
    }

    public function employees()
    {
        require_once __DIR__ . '/../View/management/employees.php';
    }

    public function instructors()
    {
        require_once __DIR__ . '/../View/management/instructors.php';
    }
}
