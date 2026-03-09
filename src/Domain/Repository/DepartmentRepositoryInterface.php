<?php
declare(strict_types = 1)
;

namespace App\Domain\Repository;

use App\Domain\Entity\Department;

interface DepartmentRepositoryInterface
{
    public function findById(int $id): ?Department;

    public function findByCode(string $code): ?Department;

    /**
     * @return Department[]
     */
    public function findAll(): array;

    public function save(Department $department): void;

    public function update(Department $department): void;

    public function delete(Department $department): void;
}
