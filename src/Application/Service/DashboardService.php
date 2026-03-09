<?php
declare(strict_types = 1)
;

namespace App\Application\Service;

use App\Application\DTO\Response\DashboardSummary;
use App\Domain\Repository\OccurrenceRepositoryInterface;
use App\Domain\Repository\StudentRepositoryInterface;
use App\Domain\ValueObject\OccurrenceStatus;

class DashboardService
{
    private StudentRepositoryInterface $studentRepository;
    private OccurrenceRepositoryInterface $occurrenceRepository;

    public function __construct(
        StudentRepositoryInterface $studentRepository,
        OccurrenceRepositoryInterface $occurrenceRepository
        )
    {
        $this->studentRepository = $studentRepository;
        $this->occurrenceRepository = $occurrenceRepository;
    }

    public function getSummary(): DashboardSummary
    {
        $students = $this->studentRepository->findAll();
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
            count($students),
            count($occurrences),
            $openOccurrencesCount,
            $resolvedOccurrencesCount
            );
    }
}
