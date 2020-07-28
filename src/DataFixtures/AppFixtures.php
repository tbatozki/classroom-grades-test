<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Student;
use App\Entity\SchoolClass;
use App\Entity\Grade;

class AppFixtures extends Fixture
{
    private $students = [
        [
            'name' => 'Denis',
            'firstname' => 'Alain',
            'birthdate' => '2009-05-12',
            'schoolClass' => [
                'label'             => '6C',
                'graduationYear'    => '6ème'
            ],
            'grades' => [
                [
                    'value' => '12',
                    'subject' => 'Histoire'
                ],
                [
                    'value' => '11',
                    'subject' => 'Maths'
                ],
                [
                    'value' => '8',
                    'subject' => 'Maths'
                ],
                [
                    'value' => '16',
                    'subject' => 'Français'
                ],
                [
                    'value' => '15',
                    'subject' => 'Anglais'
                ],
                [
                    'value' => '8',
                    'subject' => 'Maths'
                ],
                [
                    'value' => '13',
                    'subject' => 'Français'
                ],
            ]
        ],
        [
            'name' => 'Robert',
            'firstname' => 'Aline',
            'birthdate' => '2006-03-03',
            'schoolClass' => [
                'label'             => '3G',
                'graduationYear'    => '3ème'
            ],
            'grades' => [
                [
                    'value' => '8',
                    'subject' => 'Anglais'
                ],
                [
                    'value' => '5',
                    'subject' => 'Français'
                ],
                [
                    'value' => '18',
                    'subject' => 'Maths'
                ],
                [
                    'value' => '17',
                    'subject' => 'Histoire'
                ],
                [
                    'value' => '10',
                    'subject' => 'Anglais'
                ],
                [
                    'value' => '8',
                    'subject' => 'Français'
                ],
                [
                    'value' => '16',
                    'subject' => 'Maths'
                ],
                [
                    'value' => '9',
                    'subject' => 'Anglais'
                ],
            ]
        ],
    ];

    /*
        Loads data fixtures
    */
    public function load(ObjectManager $manager)
    {
        foreach ($this->students as $s) {
            $student = $this->setStudentAttributes(new Student(), $s);
            $manager->persist($student);
        }

        $manager->flush();
    }

    /*
        Sets a student's attributes according to a given array
        @var    $student    Student
        @var    $data       array

        @return $student    Student
    */
    private function setStudentAttributes(Student $student, $data) : Student
    {
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'birthdate' :
                    $student->setBirthdate(new \DateTime($value));
                    break;
                case 'schoolClass':
                    $student->setSchoolClass($this->setData($value, new SchoolClass()));
                    break;
                case 'grades':
                    foreach($value as $gradeData) {
                        $student->addGrade($this->setData($gradeData, new Grade()));
                    }
                    break;
                default:
                    $setter = $this->getSetter($key);
                    $student->$setter($value);
            }
        }

        return $student;
    }

    /*
        Concatenates values to get a setter method

        @return string
    */
    private function getSetter(string $key) : string
    {
        return 'set'.ucfirst($key);
    }

    /*
        Sets values on an entity

        @return $object
    */
    private function setData(array $data, $object)
    {
        foreach($data as $key => $value) {
            $setter = $this->getSetter($key);
            $object->$setter($value);
        }

        return $object;
    }
}
