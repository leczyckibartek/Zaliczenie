<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
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
    private $sender;

    /**
     * @Assert\NotBlank(message="To pole nie może być puste")
     *      @Assert\Length(
     *      max = 30,
     *      maxMessage = "Wyraz nie może być dłuższy niż {{ limit }} znaków"
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $receiver;

    /**
     * @Assert\NotBlank(message="To pole nie może być puste")
     *       @Assert\Length(
     *      max = 255,
     *      maxMessage = "Wyraz nie może być dłuższy niż {{ limit }} znaków"
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * @Assert\NotBlank(message="To pole nie może być puste")
     *       @Assert\Length(
     *      max = 50,
     *      maxMessage = "Wyraz nie może być dłuższy niż {{ limit }} znaków"
     * )
     * @ORM\Column(type="string", length=50)
     */
    private $subject;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;
    public function __construct()
    {

        $this->date = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSender(): ?string
    {
        return $this->sender;
    }

    public function setSender(string $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getReceiver(): ?string
    {
        return $this->receiver;
    }

    public function setReceiver(string $receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

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
