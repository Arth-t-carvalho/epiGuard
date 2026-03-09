<?php
declare(strict_types = 1)
;

namespace App\Application\DTO\Request;

class CreateOccurrenceRequest
{
    public int $studentId;
    public int $registeredById;
    public int $epiItemId;
    public string $type;
    public string $description;
    public string $date;
    public array $evidences = [];

    public function __construct(
        int $studentId,
        int $registeredById,
        int $epiItemId,
        string $type,
        string $description,
        string $date,
        array $evidences = []
        )
    {
        $this->studentId = $studentId;
        $this->registeredById = $registeredById;
        $this->epiItemId = $epiItemId;
        $this->type = $type;
        $this->description = $description;
        $this->date = $date;
        $this->evidences = $evidences;
    }
}
