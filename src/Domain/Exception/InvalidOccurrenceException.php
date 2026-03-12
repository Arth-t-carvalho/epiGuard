<?php
declare(strict_types = 1)
;

namespace App\Domain\Exception;

class InvalidOccurrenceException extends DomainException
{
    public static function invalidStatusTransition(string $current, string $new): self
    {
        return new self("Cannot change occurrence status from {$current} to {$new}.");
    }
}
