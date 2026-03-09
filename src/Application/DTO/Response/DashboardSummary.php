<?php
declare(strict_types = 1)
;

namespace App\Application\DTO\Response;

class DashboardSummary
{
    public int $totalStudents;
    public int $totalOccurrences;
    public int $openOccurrences;
    public int $resolvedOccurrences;

    public function __construct(
        int $totalStudents = 0,
        int $totalOccurrences = 0,
        int $openOccurrences = 0,
        int $resolvedOccurrences = 0
        )
    {
        $this->totalStudents = $totalStudents;
        $this->totalOccurrences = $totalOccurrences;
        $this->openOccurrences = $openOccurrences;
        $this->resolvedOccurrences = $resolvedOccurrences;
    }
}
