<?php
declare(strict_types = 1)
;

namespace App\Application\DTO\Request;

class CreateStudentRequest
{
    public string $name;
    public string $cpf;
    public string $enrollmentNumber;
    public int $courseId;
    public ?string $email;

    public function __construct(
        string $name,
        string $cpf,
        string $enrollmentNumber,
        int $courseId,
        ?string $email = null
        )
    {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->enrollmentNumber = $enrollmentNumber;
        $this->courseId = $courseId;
        $this->email = $email;
    }
}
