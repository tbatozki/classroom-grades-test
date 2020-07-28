<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ClassroomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ClassroomRepository::class)
 */
class Classroom
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
    */
    private $label;

    /**
     * @ORM\Column(type="string")
     */
    private $graduationYear;

    /**
     * @ORM\OneToMany(targetEntity=Student::class, mappedBy="classroom")
     */
    private $students;

    /*
        Class constructor
    */
    public function __construct()
    {
        $this->students = new ArrayCollection();
    }

    /*
        Gets the classroom identifier

        @return $id integer
    */
    public function getId(): ?int
    {
        return $this->id;
    }

    /*
        Gets the classroom label

        @return $label string
    */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /*
        Sets the classroom label
        @var $label    string

        @return $this
    */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /*
        Gets the classroom graduation year

        @return $graduationYear string
    */
    public function getGraduationYear(): ?string
    {
        return $this->graduationYear;
    }

    /*
        Sets the classroom graduation year
        @var $graduationYear    string

        @return $this
    */
    public function setGraduationYear(string $graduationYear): self
    {
        $this->graduationYear = $graduationYear;

        return $this;
    }

    /**
     * @return Collection|Student[]
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    /*
        Adds a new student to students collection
        @var $student   Entity

        @return $this
    */
    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->setClassroom($this);
        }

        return $this;
    }

    /*
        Removes student to students collection
        @var $student   Entity

        @return $this
    */
    public function removeStudent(Student $student): self
    {
        if ($this->students->contains($student)) {
            $this->students->removeElement($student);
            // set the owning side to null (unless already changed)
            if ($student->getClassroom() === $this) {
                $student->setClassroom(null);
            }
        }

        return $this;
    }
}
