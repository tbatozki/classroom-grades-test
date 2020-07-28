<?php
// classroom-grades-test/src/Manager/SchoolClassManager.php

namespace App\Manager;

use App\Entity\SchoolClass;

/**
*   SchoolClassManager
*/
class SchoolClassManager
{
    /*
        Gets a school class grade average
        --> gets the school class overall average if no subject is specified
        --> gets the school class grade average on a specific subject if
            $subject argument is not null
        @var    $student    Student
        @var    $subject    string (optionnal)

        @return float
    */
    public function getGradeAverage(Classroom $classroom, string $subject = null): ?float
    {
        $students = $classroom->getStudents();

        foreach ($students as $student) {
            $data = $this->retrieveGradesTotal($student, $subject);
            $values += $data['values'];
            $cpt += $data['cpt'];
        }

        return $values/$cpt;
    }

    /*
        Retrieves the addition of a student's grade whether globally or
        distinctly according to a given subject passed as function argument
        @var    $student    Student
        @var    $subject    string (optionnal)

        @return array
    */
    private function retrieveGradesTotal(Student $student, $subject = null): ?array {
        foreach ($student->getGrades() as $grade) {
            if (!is_null($subject)) {
                if ($grade->getSubject() == $subject) {
                    $values += (float)$grade->getValue();
                    $cpt++;
                }
                continue;
            }

            $values += (float)$grade->getValue();
            $cpt++;
        }

        return [
            'values' => $values,
            'cpt' => $cpt
        ];
    }
}
