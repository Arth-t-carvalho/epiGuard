<?php
declare(strict_types = 1)
;

namespace App\Domain\Exception;

class StudentNotFoundException extends DomainException
{
    public static function withId(int $id): self
    {
        return new self("Student with ID {$id} not found.");
    }

    public static function withCpf(string $cpf): self
    {
        return new self("Student with CPF {$cpf} not found.");
    }
}
