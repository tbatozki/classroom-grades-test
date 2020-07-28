<?php
// classroom-grades-test/src/Controller/ClassController.php

namespace App\Controller;

use App\Entity\SchoolClass;
use App\Manager\SchoolClassManager;
use App\Manager\GradeManager;
use App\Handler\SchoolClassHandler;

/**
*   SchoolClassController
*   @var    $schoolClassManager     SchoolClassManager
*   @var    $gradeManager           GradeManager
*   @var    $schoolClassHandler     SchoolClassHandler
*/
class SchoolClassController
{
    private $schoolClassManager;
    private $gradeManager;
    private $schoolClassHandler;

    public function __construct(
        SchoolClassManager $schoolClassManager,
        GradeManager $gradeManager,
        SchoolclassHandler $schoolClassHandler
    ) {
        $this->schoolClassManager   = $schoolClassManager;
        $this->GradeManager         = $gradeManager;
        $this->schoolClassHandler   = $schoolClassHandler;
    }

    public function __invoke(SchoolClass $data): SchoolClass
    {
        $this->schoolClassHandler->handle($data);

        return $data;
    }

    /*
        Evaluates school overall average

        @return string
    */
    public function getSchoolOverallAverage(): ?string
    {
        return $this->GradeManager->getSchoolGradeAverage();
    }

    /*
        Evaluates school average on a given subject
        @var    $subject    string

        @return string
    */
    public function getSchoolAverageBySubject(string $subject): ?string
    {
        return $this->gradeManager->getSchoolGradeAverage($subject);
    }

    /*
        Gets school class overall average
        @var    $id     int : the school class id

        @return string
    */
    public function getSchoolClassOverallAverage(int $id): ?string
    {
        $schoolClass = $this->schoolClassHandler->getSchoolClass($id);
        return $this->schoolClassManager->getGradeAverage($schoolClass);
    }

    /*
        Gets school class average on a given subject
        @var    $id         int : school class id
        @var    $subject    string

        @return string
    */
    public function getSchoolClassAverageBySubject(int $id, string $subject): ?string
    {
        $schoolClass = $this->schoolClassHandler->getSchoolClass($id);
        return $this->schoolClassManager->getGradeAverage($schoolClass, $subject);
    }
}
