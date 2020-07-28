<?php
// classroom-grades-test/src/Manager/GradeManager.php

namespace App\Manager;

use App\Entity\Grade;
use App\Repository\GradeRepository;

/**
*   GradeManager
*   @var    $gradeRepository    GradeRepository
*/
class GradeManager
{
    private $gradeRepository;

    public function __construct(GradeRepository $gradeRepository)
    {
        $this->gradeRepository = $gradeRepository;
    }

    /*
        Gets school overall grade average if no subject is specified, if a given
        subject is passed as argument, then gives the school average on the given
        subject
        @var    $subject    string (optionnal)

        @return float
    */
    public function getSchoolGradeAverage(string $subject = null): ?float
    {
        $grades = (!is_null($subject))
            ? $this->$this->gradeRepository->findBy(['subject' => $subject])
            : $this->gradeRepository->findAll()
        ;

        foreach ($grades as $grade) {
            $values += (float)$grade['value'];
            $cpt++;
        }

        return $values/$cpt;
    }
}
