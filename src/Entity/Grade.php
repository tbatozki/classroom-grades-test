<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GradeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=GradeRepository::class)
 */
class Grade
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=2)
     * @Assert\Range(
     *      min = 0,
     *      max = 20,
     *      notInRangeMessage = "Grade value must be between {{ min }} and {{ max }}",
     * )
     */
    private $value;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subject;

    /**
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="grades")
     */
    private $student;

    /*
        Gets grade identifier

        @return $id integer
    */
    public function getId(): ?int
    {
        return $this->id;
    }

    /*
        Gets grade value

        @return $value string
    */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /*
        Sets grade value
        @var $value string

        @return $this
    */
    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /*
        Gets grade subject

        @return $subject    string
    */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /*
        Sets grade subject
        @var $subject   string

        @return $this
    */
    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    /*
        Gets the student the grade is associated with

        @return $student  Student
    */
    public function getStudent(): ?Student
    {
        return $this->student;
    }

    /*
        Sets the student the grade is associated with
        @var $student Entity

        @return $this
    */
    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }
}
