<?php
// classroom-grades-test/src/Controller/StudentController.php

namespace App\Controller;

use App\Entity\Student;
use App\Manager\StudentManager;
use App\Handler\StudentHandler;

/**
*   StudentController
*   @var    $studentManager
*   @var    $studentHandler
*/
class StudentController
{
    private $studentManager;
    private $studentHandler;

    public function __construct(StudentManager $studentManager, studentHandler $studentHandler)
    {
        $this->studentManager = $studentManager;
        $this->studentHandler = $studentHandler;
    }

    public function __invoke(Student $data): Student
    {
        $this->studentHandler->handle($data);

        return $data;
    }

    /*
        Gets student's overall average
        @var    $studentId  integer

        @return float
    */
    public function getStudentOverallAverage(int $studentId)
    {
        return $this->studentManager->getGradeAverage($studentId);
    }

    /*
        Gets student average grade on a given subject
        @var    $studentId  integer
        @var    $subject    string

        @return float
    */
    public function getStudentAverageBySubject(int $studentId, string $subject)
    {
        return $this->studentManager->getGradeAverage($studentId, $subject);
    }
}
