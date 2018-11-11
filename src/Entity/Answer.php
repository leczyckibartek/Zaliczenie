<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnswerRepository")
 */
class Answer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $idOffert;

    /**
     * @ORM\Column(type="integer")
     */
    private $idCv;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdOffert(): ?int
    {
        return $this->idOffert;
    }

    public function setIdOffert(int $idOffert): self
    {
        $this->idOffert = $idOffert;

        return $this;
    }

    public function getIdCv(): ?int
    {
        return $this->idCv;
    }

    public function setIdCv(int $idCv): self
    {
        $this->idCv = $idCv;

        return $this;
    }
}
