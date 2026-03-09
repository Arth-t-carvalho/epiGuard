<?php
declare(strict_types = 1)
;

namespace App\Domain\Repository;

use App\Domain\Entity\Occurrence;

interface OccurrenceRepositoryInterface
{
    public function findById(int $id): ?Occurrence;

    /**
     * @return Occurrence[]
     */
    public function findAll(): array;

    /**
     * @param int $studentId
     * @return Occurrence[]
     */
    public function findByStudentId(int $studentId): array;

    /**
     * @param string $status
     * @return Occurrence[]
     */
    public function findByStatus(string $status): array;

    public function save(Occurrence $occurrence): void;

    public function update(Occurrence $occurrence): void;

    public function delete(Occurrence $occurrence): void;
}
