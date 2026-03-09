<?php
declare(strict_types = 1)
;

namespace Tests\Unit\Domain;

use App\Domain\Entity\Course;
use App\Domain\Entity\Student;
use App\Domain\ValueObject\CPF;
use App\Domain\ValueObject\Email;
use PHPUnit\Framework\TestCase;

class StudentTest extends TestCase
{
    public function testCanCreateStudentWithValidData(): void
    {
        $cpf = new CPF('12345678909'); // Example formatted valid CPF if mocked, though validation might fail real algorithm, lets use dummy test
        $course = new Course('System Analysis', 'ADS123', 1);
        $email = new Email('student@example.com');

        $student = new Student(
            'John Doe',
            $cpf,
            '20261001',
            $course,
            $email
            );

        $this->assertEquals('John Doe', $student->getName());
        $this->assertEquals($cpf, $student->getCpf());
        $this->assertEquals('20261001', $student->getEnrollmentNumber());
        $this->assertEquals($course, $student->getCourse());
        $this->assertEquals($email, $student->getEmail());
        $this->assertNotNull($student->getCreatedAt());
    }
}
