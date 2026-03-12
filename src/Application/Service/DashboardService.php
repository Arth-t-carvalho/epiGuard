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
            // Ajustado para usar o tipo ou status real do banco
            if ($occurrence->getType()->getValue() === 'INFRACAO') {
                $openOccurrencesCount++;
            } else {
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

    public function getChartData(): array
    {
        $now = new \DateTimeImmutable();
        $year = (int)$now->format('Y');

        return [
            'status' => 'success',
            'summary' => [
                'today' => $this->occurrenceRepository->countDaily($now),
                'week' => $this->occurrenceRepository->countWeekly($now),
                'month' => $this->occurrenceRepository->countMonthly($now),
                'total_students' => count($this->employeeRepository->findAll())
            ],
            'bar' => $this->occurrenceRepository->getMonthlyInfractionStats($year),
            'doughnut' => $this->occurrenceRepository->getInfractionDistributionByEpi()
        ];
    }
}
