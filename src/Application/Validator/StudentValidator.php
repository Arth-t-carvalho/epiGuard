<?php
declare(strict_types = 1)
;

namespace App\Application\Validator;

use App\Application\DTO\Request\CreateStudentRequest;
use App\Domain\Exception\ValidationException;

class StudentValidator
{
    /**
     * @param CreateStudentRequest $request
     * @throws ValidationException
     */
    public function validateCreation(CreateStudentRequest $request): void
    {
        $errors = [];

        if (empty(trim($request->name)) || strlen(trim($request->name)) < 3) {
            $errors['name'] = 'Name must be at least 3 characters long.';
        }

        if (empty($request->cpf)) {
            $errors['cpf'] = 'CPF is required.';
        }

        if (empty($request->enrollmentNumber)) {
            $errors['enrollmentNumber'] = 'Enrollment number is required.';
        }

        if ($request->courseId <= 0) {
            $errors['courseId'] = 'Valid course ID is required.';
        }

        if ($request->email !== null && !filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email format is invalid.';
        }

        if (!empty($errors)) {
            throw new ValidationException('Student validation failed.', $errors);
        }
    }
}
