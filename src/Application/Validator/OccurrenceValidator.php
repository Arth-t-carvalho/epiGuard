<?php
declare(strict_types = 1)
;

namespace App\Application\Validator;

use App\Application\DTO\Request\CreateOccurrenceRequest;
use App\Domain\Exception\ValidationException;

class OccurrenceValidator
{
    /**
     * @param CreateOccurrenceRequest $request
     * @throws ValidationException
     */
    public function validateCreation(CreateOccurrenceRequest $request): void
    {
        $errors = [];

        if ($request->studentId <= 0) {
            $errors['studentId'] = 'Valid student ID is required.';
        }

        if ($request->epiItemId <= 0) {
            $errors['epiItemId'] = 'Valid EPI Item ID is required.';
        }

        if (empty(trim($request->type))) {
            $errors['type'] = 'Occurrence type is required.';
        }

        if (empty(trim($request->description)) || strlen(trim($request->description)) < 5) {
            $errors['description'] = 'Description must be at least 5 characters long.';
        }

        if (empty(trim($request->date))) {
            $errors['date'] = 'Date is required.';
        }
        else {
            $format = 'Y-m-d';
            $d = \DateTime::createFromFormat($format, $request->date);
            if (!$d || $d->format($format) !== $request->date) {
                $errors['date'] = 'Date must be in Y-m-d format.';
            }
        }

        if (!empty($errors)) {
            throw new ValidationException('Occurrence validation failed.', $errors);
        }
    }
}
