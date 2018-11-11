<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SkillCvRepository")
 */
class SkillCv
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;



    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CvMain", inversedBy="skillCvs")
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

    public function setName(?string $name): self
    {
        $this->name = $name;

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
