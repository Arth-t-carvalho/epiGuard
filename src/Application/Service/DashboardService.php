<?php
declare(strict_types = 1)
;

namespace App\Application\Service;

use App\Application\DTO\Response\DashboardSummary;
use App\Domain\Repository\OccurrenceRepositoryInterface;
use App\Domain\Repository\EmployeeRepositoryInterface;
use App\Domain\ValueObject\OccurrenceStatus;

class DashboardService
{
    private EmployeeRepositoryInterface $employeeRepository;
    private OccurrenceRepositoryInterface $occurrenceRepository;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        OccurrenceRepositoryInterface $occurrenceRepository
        )
    {
        $this->employeeRepository = $employeeRepository;
        $this->occurrenceRepository = $occurrenceRepository;
    }

    public function getSummary(): DashboardSummary
    {
        $employees = $this->employeeRepository->findAll();
        $occurrences = $this->occurrenceRepository->findAll();

        $openOccurrencesCount = 0;
        $resolvedOccurrencesCount = 0;

        foreach ($occurrences as $occurrence) {
            if ($occurrence->getStatus()->isOpen() || $occurrence->getStatus()->getValue() === OccurrenceStatus::IN_PROGRESS) {
                $openOccurrencesCount++;
            }
            elseif ($occurrence->getStatus()->getValue() === OccurrenceStatus::RESOLVED || $occurrence->getStatus()->getValue() === OccurrenceStatus::CLOSED) {
                $resolvedOccurrencesCount++;
            }
        }

        return new DashboardSummary(
            count($employees),
            count($occurrences),
            $openOccurrencesCount,
            $resolvedOccurrencesCount
            );
    }
}
