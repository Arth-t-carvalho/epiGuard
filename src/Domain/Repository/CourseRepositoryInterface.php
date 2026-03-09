<?php
declare(strict_types = 1)
;

namespace App\Domain\Repository;

use App\Domain\Entity\Course;

interface CourseRepositoryInterface
{
    public function findById(int $id): ?Course;

    public function findByCode(string $code): ?Course;

    /**
     * @return Course[]
     */
    public function findAll(): array;

    public function save(Course $course): void;

    public function update(Course $course): void;

    public function delete(Course $course): void;
}
