<?php
declare(strict_types = 1)
;

namespace Tests\Unit\Application;

use App\Application\DTO\Request\CreateOccurrenceRequest;
use App\Application\Service\OccurrenceService;
use App\Application\Validator\OccurrenceValidator;
use App\Domain\Entity\Course;
use App\Domain\Entity\EpiItem;
use App\Domain\Entity\Student;
use App\Domain\Entity\User;
use App\Domain\Exception\ValidationException;
use App\Domain\Repository\EpiRepositoryInterface;
use App\Domain\Repository\OccurrenceRepositoryInterface;
use App\Domain\Repository\StudentRepositoryInterface;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\ValueObject\CPF;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\UserRole;
use PHPUnit\Framework\TestCase;

class OccurrenceServiceTest extends TestCase
{
    public function testCreateOccurrenceValidatesInput(): void
    {
        $mockOccurrenceRepo = $this->createMock(OccurrenceRepositoryInterface::class);
        $mockStudentRepo = $this->createMock(StudentRepositoryInterface::class);
        $mockUserRepo = $this->createMock(UserRepositoryInterface::class);
        $mockEpiRepo = $this->createMock(EpiRepositoryInterface::class);

        $validator = new OccurrenceValidator();
        $service = new OccurrenceService($mockOccurrenceRepo, $mockStudentRepo, $mockUserRepo, $mockEpiRepo, $validator);

        // Intentionally missing data
        $request = new CreateOccurrenceRequest(0, 0, 0, '', '', '');

        $this->expectException(ValidationException::class);
        $service->createOccurrence($request);
    }
}
