<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="date")
     */
    private $birthdate;

    /**
     * @ORM\ManyToOne(targetEntity=Classroom::class, inversedBy="students", cascade={"persist"})
     */
    private $classroom;

    /**
     * @ORM\OneToMany(targetEntity=Grade::class, mappedBy="student", cascade={"persist"})
     */
    private $grades;

    /*
        Class constructor
    */
    public function __construct()
    {
        $this->grades = new ArrayCollection();
    }

    /*
        Gets student's identifier

        @return $id integer
    */
    public function getId(): ?int
    {
        return $this->id;
    }

    /*
        Gets student's namespace

        @return $name string
    */
    public function getName(): ?string
    {
        return $this->name;
    }

    /*
        Sets student's name
        @var $name  string

        @return $this
    */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /*
        Gets student's firstname

        @return $firstname string
    */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /*
        Sets student's firstname
        @var $firstname string

        @return $this
    */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /*
        Gets student's birthdate

        @return $birthdate date
    */
    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

/*
    Set student's birthdate
    @var $birthdate DateTime

    @return $this
*/
    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /*
        Gets student's classroom

        @return $classroom  Classroom
    */
    public function getClassroom(): ?Classroom
    {
        return $this->classroom;
    }

    /*
        Sets student's classroom
        @var $classroom Entity

        @return $this
    */
    public function setClassroom(?Classroom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }

    /**
     * @return Collection|Grade[]
     */
    public function getGrades(): Collection
    {
        return $this->grades;
    }

    /*
        Adds a new grade to grades collection
        @var $grade   Entity

        @return $this
    */
    public function addGrade(Grade $grade): self
    {
        if (!$this->grades->contains($grade)) {
            $this->grades[] = $grade;
            $grade->setStudent($this);
        }

        return $this;
    }

    /*
        Removes grade to grades collection
        @var $grade   Entity

        @return $this
    */
    public function removeGrade(Grade $grade): self
    {
        if ($this->grades->contains($grade)) {
            $this->grades->removeElement($grade);
            // set the owning side to null (unless already changed)
            if ($grade->getStudent() === $this) {
                $grade->setStudent(null);
            }
        }

        return $this;
    }
}
