<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\SchoolRepository")
 */
class School
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="To pole nie może być puste")
     *        @Assert\Length(
     *      max = 100,
     *      maxMessage = "Wyraz nie może być dłuższy niż {{ limit }} znaków"
     * )
     * @ORM\Column(type="string", length=100,nullable=true)
     */
    private $name;

    /**
     * @Assert\NotBlank(message="To pole nie może być puste")
     *        @Assert\Length(
     *      max = 50,
     *      maxMessage = "Wyraz nie może być dłuższy niż {{ limit }} znaków"
     * )
     * @ORM\Column(type="string", length=50,nullable=true)
     */
    private $title;

    /**
     * @Assert\NotBlank(message="To pole nie może być puste")
     * @ORM\Column(type="date",nullable=true)
     */
    private $start;

    /**
     * @Assert\NotBlank(message="To pole nie może być puste")
     * @ORM\Column(type="date", nullable=true)
     */
    private $finish;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CvMain", inversedBy="schools")
     */

    private $cv;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getFinish(): ?\DateTimeInterface
    {
        return $this->finish;
    }

    public function setFinish(?\DateTimeInterface $finish): self
    {
        $this->finish = $finish;

        return $this;
    }

    public function getCv(): ?CvMain
    {
        return $this->cv;
    }

    public function setCv(?CvMain $cv): self
    {
        $this->cv = $cv;

        return $this;
    }
}
