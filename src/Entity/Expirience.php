<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


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
     * @Assert\NotBlank(message="To pole nie może być puste")
     *    @Assert\Length(
     *      max = 30,
     *      maxMessage = "Wyraz nie może być dłuższy niż {{ limit }} znaków"
     * )
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $nameOfJob;

    /**
     * @Assert\NotBlank(message="To pole nie może być puste")
     *      @Assert\Length(
     *      max = 50,
     *      maxMessage = "Wyraz nie może być dłuższy niż {{ limit }} znaków"
     * )
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CvMain", inversedBy="expiriences")
     */
    private $cv;

    /**
     * @ORM\Column(type="date")
     */
    private $start;

    /**
     * @ORM\Column(type="date")
     */
    private $finish;

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

    public function setFinish(\DateTimeInterface $finish): self
    {
        $this->finish = $finish;

        return $this;
    }
}
