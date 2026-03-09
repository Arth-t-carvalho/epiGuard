<?php
declare(strict_types = 1)
;

namespace App\Application\Service;

use App\Application\DTO\Request\CreateStudentRequest;
use App\Application\Validator\StudentValidator;
use App\Domain\Entity\Student;
use App\Domain\Exception\DomainException;
use App\Domain\Repository\CourseRepositoryInterface;
use App\Domain\Repository\StudentRepositoryInterface;
use App\Domain\ValueObject\CPF;
use App\Domain\ValueObject\Email;

class StudentService
{
    private StudentRepositoryInterface $studentRepository;
    private CourseRepositoryInterface $courseRepository;
    private StudentValidator $validator;

    public function __construct(
        StudentRepositoryInterface $studentRepository,
        CourseRepositoryInterface $courseRepository,
        StudentValidator $validator
        )
    {
        $this->studentRepository = $studentRepository;
        $this->courseRepository = $courseRepository;
        $this->validator = $validator;
    }

    /**
     * @param CreateStudentRequest $request
     * @return Student
     * @throws DomainException
     */
    public function createStudent(CreateStudentRequest $request): Student
    {
        $this->validator->validateCreation($request);

        try {
            $cpf = new CPF($request->cpf);
        }
        catch (\InvalidArgumentException $e) {
            throw new DomainException("Invalid CPF format provided.");
        }

        if ($this->studentRepository->findByCpf($cpf)) {
            throw new DomainException("A student with this CPF already exists.");
        }

        if ($this->studentRepository->findByEnrollmentNumber($request->enrollmentNumber)) {
            throw new DomainException("A student with this enrollment number already exists.");
        }

        $course = $this->courseRepository->findById($request->courseId);
        if (!$course) {
            throw new DomainException("The specified course does not exist.");
        }

        $email = null;
        if ($request->email) {
            try {
                $email = new Email($request->email);
            }
            catch (\InvalidArgumentException $e) {
                throw new DomainException("Invalid email format provided.");
            }
        }

        $student = new Student(
            $request->name,
            $cpf,
            $request->enrollmentNumber,
            $course,
            $email
            );

        $this->studentRepository->save($student);

        return $student;
    }
}
