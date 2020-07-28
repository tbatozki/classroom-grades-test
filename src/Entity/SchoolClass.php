<?php

namespace App\Entity;

use App\Repository\SchoolClassRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=SchoolClassRepository::class)
 */
class SchoolClass
{
    /**
     * @var int The school class id
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string The school class label
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
    */
    private $label;

    /**
     * @var string The school class graduation year
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $graduationYear;

    /**
     * @var ArrayCollection The school class students
     *
     * @ORM\OneToMany(targetEntity=Student::class, mappedBy="schoolClass")
     */
    private $students;

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->students = new ArrayCollection();
    }

    /**
     * Gets the school class identifier
     *
     * @return int
    */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Gets the school class label
     *
     * @return string
    */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * Sets the school class label
     * @var $label    string
     *
     * @return self
    */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Gets the school class graduation year
     *
     * @return string
    */
    public function getGraduationYear(): ?string
    {
        return $this->graduationYear;
    }

    /**
     * Sets the school class graduation year
     * @var $graduationYear    string
     *
     * @return self
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

    /**
     * Adds a student to school class students collection
     * @var $student Student
     *
     * @return self
    */
    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->setClassroom($this);
        }

        return $this;
    }

    /**
     * Removes a student from school class students collection
     * @var $student Student
     *
     * @return self
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
