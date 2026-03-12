<?php

namespace epiGuard\Presentation\Controller;

class ManagementController
{
    public function departments()
    {
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
