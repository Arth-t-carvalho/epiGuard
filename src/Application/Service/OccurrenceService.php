<?php
declare(strict_types = 1)
;

namespace App\Application\Service;

use App\Application\DTO\Request\CreateOccurrenceRequest;
use App\Application\DTO\Request\ResolveOccurrenceRequest;
use App\Application\Validator\OccurrenceValidator;
use App\Domain\Entity\Occurrence;
use App\Domain\Entity\OccurrenceAction;
use App\Domain\Exception\DomainException;
use App\Domain\Exception\InvalidOccurrenceException;
use App\Domain\Exception\StudentNotFoundException;
use App\Domain\Repository\EpiRepositoryInterface;
use App\Domain\Repository\OccurrenceRepositoryInterface;
use App\Domain\Repository\StudentRepositoryInterface;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\ValueObject\ActionType;
use App\Domain\ValueObject\OccurrenceStatus;
use App\Domain\ValueObject\OccurrenceType;
use DateTimeImmutable;

class OccurrenceService
{
    private OccurrenceRepositoryInterface $occurrenceRepository;
    private StudentRepositoryInterface $studentRepository;
    private UserRepositoryInterface $userRepository;
    private EpiRepositoryInterface $epiRepository;
    private OccurrenceValidator $validator;

    public function __construct(
        OccurrenceRepositoryInterface $occurrenceRepository,
        StudentRepositoryInterface $studentRepository,
        UserRepositoryInterface $userRepository,
        EpiRepositoryInterface $epiRepository,
        OccurrenceValidator $validator
        )
    {
        $this->occurrenceRepository = $occurrenceRepository;
        $this->studentRepository = $studentRepository;
        $this->userRepository = $userRepository;
        $this->epiRepository = $epiRepository;
        $this->validator = $validator;
    }

    /**
     * @param CreateOccurrenceRequest $request
     * @return Occurrence
     * @throws DomainException
     */
    public function createOccurrence(CreateOccurrenceRequest $request): Occurrence
    {
        $this->validator->validateCreation($request);

        $student = $this->studentRepository->findById($request->studentId);
        if (!$student) {
            throw StudentNotFoundException::withId($request->studentId);
        }

        $registeredBy = $this->userRepository->findById($request->registeredById);
        if (!$registeredBy) {
            throw new DomainException("Registering user not found.");
        }

        $epiItem = $this->epiRepository->findById($request->epiItemId);
        if (!$epiItem) {
            throw new DomainException("EPI Item not found.");
        }

        $occurrenceType = new OccurrenceType($request->type);
        $date = DateTimeImmutable::createFromFormat('Y-m-d', $request->date);

        $occurrence = new Occurrence(
            $student,
            $registeredBy,
            $epiItem,
            $occurrenceType,
            $request->description,
            $date
            );

        $this->occurrenceRepository->save($occurrence);

        return $occurrence;
    }

    /**
     * @param ResolveOccurrenceRequest $request
     * @return Occurrence
     * @throws DomainException
     */
    public function resolveOccurrence(ResolveOccurrenceRequest $request): Occurrence
    {
        $occurrence = $this->occurrenceRepository->findById($request->occurrenceId);
        if (!$occurrence) {
            throw new DomainException("Occurrence not found.");
        }

        if (!$occurrence->getStatus()->isOpen() && $occurrence->getStatus()->getValue() !== OccurrenceStatus::IN_PROGRESS) {
            throw InvalidOccurrenceException::invalidStatusTransition(
                $occurrence->getStatus()->getValue(),
                OccurrenceStatus::RESOLVED
            );
        }

        $resolvedBy = $this->userRepository->findById($request->resolvedById);
        if (!$resolvedBy) {
            throw new DomainException("Resolving user not found.");
        }

        $actionType = new ActionType($request->actionType);

        $action = new OccurrenceAction(
            $occurrence->getId(),
            $actionType,
            $request->actionDescription,
            $resolvedBy
            );

        $occurrence->addAction($action);
        $occurrence->changeStatus(new OccurrenceStatus(OccurrenceStatus::RESOLVED));

        $this->occurrenceRepository->update($occurrence);

        return $occurrence;
    }
}
