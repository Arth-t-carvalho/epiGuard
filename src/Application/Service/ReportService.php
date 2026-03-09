<?php
declare(strict_types = 1)
;

namespace App\Application\Service;

use App\Domain\Repository\OccurrenceRepositoryInterface;
use App\Domain\Repository\StudentRepositoryInterface;

class ReportService
{
    private OccurrenceRepositoryInterface $occurrenceRepository;
    private StudentRepositoryInterface $studentRepository;

    public function __construct(
        OccurrenceRepositoryInterface $occurrenceRepository,
        StudentRepositoryInterface $studentRepository
        )
    {
        $this->occurrenceRepository = $occurrenceRepository;
        $this->studentRepository = $studentRepository;
    }

    public function generateStudentReport(int $studentId): array
    {
        // Return a structured array or a Report DTO based on all occurrences of a student.
        return [];
    }

    public function generateGeneralReport(string $startDate, string $endDate): array
    {
        // Return analytical data summarizing operations between dates.
        return [];
    }
}
