<?php
declare(strict_types = 1)
;

namespace epiGuard\Application\Service;

use epiGuard\Application\DTO\Response\DashboardSummary;
use epiGuard\Domain\Repository\OccurrenceRepositoryInterface;
use epiGuard\Domain\Repository\EmployeeRepositoryInterface;
use epiGuard\Domain\ValueObject\OccurrenceStatus;

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

    public function getChartData(?int $sectorId = null): array
    {
        $now = new \DateTimeImmutable();
        $year = (int)$now->format('Y');

        return [
            'status' => 'success',
            'summary' => [
                'today' => $this->occurrenceRepository->countDaily($now, $sectorId),
                'week' => $this->occurrenceRepository->countWeekly($now, $sectorId),
                'month' => $this->occurrenceRepository->countMonthly($now, $sectorId),
                'total_students' => count($this->employeeRepository->findAll())
            ],
            'bar' => $this->occurrenceRepository->getMonthlyInfractionStats($year, $sectorId),
            'doughnut' => $this->occurrenceRepository->getInfractionDistributionByEpi($sectorId)
        ];
    }
}
