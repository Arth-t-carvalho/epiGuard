<?php
declare(strict_types = 1)
;

namespace App\Application\Service;

use App\Domain\Repository\OccurrenceRepositoryInterface;
use App\Domain\Repository\EmployeeRepositoryInterface;

class ReportService
{
    private OccurrenceRepositoryInterface $occurrenceRepository;
    private EmployeeRepositoryInterface $employeeRepository;

    public function __construct(
        OccurrenceRepositoryInterface $occurrenceRepository,
        EmployeeRepositoryInterface $employeeRepository
        )
    {
        $this->occurrenceRepository = $occurrenceRepository;
        $this->employeeRepository = $employeeRepository;
    }

    public function generateEmployeeReport(int $employeeId): array
    {
        // Return a structured array or a Report DTO based on all occurrences of a employee.
        return [];
    }

    public function generateGeneralReport(string $startDate, string $endDate): array
    {
        // Return analytical data summarizing operations between dates.
        return [];
    }
}
