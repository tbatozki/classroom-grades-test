<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
{
    /**
     * @var int The student's id
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string Student's name
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var string Student's firstname
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $firstname;

    /**
     * @var \DateTime Student's birthdate
     *
     * @ORM\Column(type="date")
     * @Assert\NotBlank
     * @Assert\DateTime
     */
    private $birthdate;

    /**
     * @var SchoolClass School class the student belongs to
     *
     * @ORM\ManyToOne(targetEntity=SchoolClass::class, inversedBy="students", cascade={"persist"})
     */
    private $schoolClass;

    /**
     * @var ArrayCollection Student's collection of grades
     *
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

    /**
     * Gets student's identifier
     *
     * @return int
    */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Gets student's namespace
     *
     * @return string
    */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets student's name
     * @var $name  string
     *
     * @return self
    */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets student's firstname
     *
     * @return string
    */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * Sets student's firstname
     * @var $firstname string
     *
     * @return self
    */
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Gets student's birthdate
     *
     * @return \DateTimeInterface
    */
    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    /**
     * Set student's birthdate
     * @var $birthdate \DateTimeInterface
     *
     * @return self
    */
    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Gets student's school class
     *
     * @return SchoolClass
    */
    public function getSchoolClass(): ?SchoolClass
    {
        return $this->schoolClass;
    }

    /**
     * Sets student's school class
     * @var $schoolClass SchoolClass
     *
     * @return self
    */
    public function setSchoolClass(?SchoolClass $schoolClass): self
    {
        $this->schoolClass = $schoolClass;

        return $this;
    }

    /**
     * Get all student's grades
     *
     * @return Collection|Grade[]
     */
    public function getGrades(): Collection
    {
        return $this->grades;
    }

    /**
     * Adds a new grade to student's grades collection
     * @var $grade Grade
     *
     * @return self
    */
    public function addGrade(Grade $grade): self
    {
        if (!$this->grades->contains($grade)) {
            $this->grades[] = $grade;
            $grade->setStudent($this);
        }

        return $this;
    }

    /**
     * Removes grade from student's grades collection
     * @var $grade Grade
     *
     * @return self
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
