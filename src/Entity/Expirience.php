<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExpirienceRepository")
 */
class Expirience
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $nameOfJob;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CvMain", inversedBy="expiriences")
     */
    private $cv;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameOfJob(): ?string
    {
        return $this->nameOfJob;
    }

    public function setNameOfJob(?string $nameOfJob): self
    {
        $this->nameOfJob = $nameOfJob;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(?string $company): self
    {
        $this->company = $company;

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
