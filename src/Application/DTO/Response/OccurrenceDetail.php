<?php
declare(strict_types = 1)
;

namespace App\Application\DTO\Response;

class OccurrenceDetail
{
    public int $id;
    public string $studentName;
    public string $studentCourse;
    public string $registeredBy;
    public string $epiItem;
    public string $type;
    public string $status;
    public string $description;
    public string $date;
    public array $evidences = [];
    public array $actions = [];

    public function __construct(
        int $id,
        string $studentName,
        string $studentCourse,
        string $registeredBy,
        string $epiItem,
        string $type,
        string $status,
        string $description,
        string $date,
        array $evidences = [],
        array $actions = []
        )
    {
        $this->id = $id;
        $this->studentName = $studentName;
        $this->studentCourse = $studentCourse;
        $this->registeredBy = $registeredBy;
        $this->epiItem = $epiItem;
        $this->type = $type;
        $this->status = $status;
        $this->description = $description;
        $this->date = $date;
        $this->evidences = $evidences;
        $this->actions = $actions;
    }
}
