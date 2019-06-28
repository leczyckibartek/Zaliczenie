<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnswerRepository")
 * @ORM\HasLifecycleCallbacks()
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

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    private $answer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $userId;
    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $taskId;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $date;


    /**
     * @ORM\PreUpdate()
     */
    public function setNewDate()
    {
        $this->date = new \DateTime();
    }

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
    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    public function getUserId(): ?string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): self
    {
        $this->userId = $userId;

        return $this;
    }
    public function getTaskId(): ?int
    {
        return $this->taskId;
    }

    public function setTaskId(int $taskId): self
    {
        $this->taskId = $taskId;

        return $this;
    }
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

}
