<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="string", length=100,nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50,nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $start;

    /**
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
