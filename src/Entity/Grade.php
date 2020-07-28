<?php

namespace App\Entity;

use App\Repository\GradeRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=GradeRepository::class)
 */
class Grade
{
    /**
     * @var int Grade id
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var float Grade value between 0 and 20
     *
     * @ORM\Column(type="decimal", precision=4, scale=2)
     * @Assert\Range(
     *      min = 0,
     *      max = 20,
     *      notInRangeMessage = "Grade value must be between {{ min }} and {{ max }}",
     * )
     * @Assert\Type(type="decimal")
     * @Assert\NotBlank
     */
    private $value;

    /**
     * @var string The grade subject
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $subject;

    /**
     * @var Student Student the grade is attributed to
     *
     * @ORM\ManyToOne(targetEntity=Student::class, inversedBy="grades")
     */
    private $student;

    /**
     * Gets grade identifier
     *
     * @return int
    */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Gets grade value
     *
     * @return string
    */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * Sets grade value
     * @var $value string
     *
     * @return self
    */
    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Gets grade subject
     *
     * @return string
    */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * Sets grade subject
     * @var $subject   string
     *
     * @return self
    */
    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Gets the student the grade is associated with
     *
     * @return Student
    */
    public function getStudent(): ?Student
    {
        return $this->student;
    }

    /**
     * Sets the student the grade is associated with
     * @var $student Student
     *
     * @return self
    */
    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }
}
