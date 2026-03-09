<?php
declare(strict_types = 1)
;

namespace App\Domain\Repository;

use App\Domain\Entity\Student;
use App\Domain\ValueObject\CPF;

interface StudentRepositoryInterface
{
    public function findById(int $id): ?Student;

    public function findByCpf(CPF $cpf): ?Student;

    public function findByEnrollmentNumber(string $enrollmentNumber): ?Student;

    /**
     * @return Student[]
     */
    public function findAll(): array;

    /**
     * @param int $courseId
     * @return Student[]
     */
    public function findByCourse(int $courseId): array;

    public function save(Student $student): void;

    public function update(Student $student): void;

    public function delete(Student $student): void;
}
