<?php
// classroom-grades-test/src/Manager/StudentManager.php

namespace App\Manager;

use App\Entity\Student;

/**
*   StudentManager
*/
class StudentManager
{
    /*
        Gets a student grade average
        --> gets the overall average if no subject is specified
        --> gets a specific subject grade average if $subject is not null
        @var    $student    Student
        @var    $subject    string (optionnal)

        @return float
    */
    public function getGradeAverage(Student $student, string $subject = null): ?float
    {
        $grades = $student->getGrades();

        foreach ($grades as $grade) {
            $cpt++;

            if (!is_null($subject)) {
                if ($grade->getSubject() == $subject) {
                    $values += $grade->getValue();
                }
                
                continue;
            }

            $values += $grade->getValue();
        }

        return $values/$cpt;
    }
}
