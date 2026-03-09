<?php
declare(strict_types = 1)
;

namespace App\Application\DTO\Response;

class StudentListItem
{
    public int $id;
    public string $name;
    public string $enrollmentNumber;
    public string $courseCode;
    public int $occurrencesCount;

    public function __construct(
        int $id,
        string $name,
        string $enrollmentNumber,
        string $courseCode,
        int $occurrencesCount = 0
        )
    {
        $this->id = $id;
        $this->name = $name;
        $this->enrollmentNumber = $enrollmentNumber;
        $this->courseCode = $courseCode;
        $this->occurrencesCount = $occurrencesCount;
    }
}
