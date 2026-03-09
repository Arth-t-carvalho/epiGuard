<?php
declare(strict_types = 1)
;

namespace App\Application\Service;

use App\Domain\Entity\Course;
use App\Domain\Repository\CourseRepositoryInterface;

class CourseService
{
    private CourseRepositoryInterface $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * @return Course[]
     */
    public function getAllCourses(): array
    {
        return $this->courseRepository->findAll();
    }
}
