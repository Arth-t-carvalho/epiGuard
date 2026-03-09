<?php
declare(strict_types = 1)
;

namespace App\Application\Service;

use App\Domain\Entity\Department;
use App\Domain\Repository\DepartmentRepositoryInterface;

class DepartmentService
{
    private DepartmentRepositoryInterface $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * @return Department[]
     */
    public function getAllDepartments(): array
    {
        return $this->departmentRepository->findAll();
    }
}
