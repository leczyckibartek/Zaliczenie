<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\OffertRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Offert
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=50)
     */
    private $employer_id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="To pole nie może być puste")
     *    @Assert\Length(
     *      max = 50,
     *      maxMessage = "Wyraz nie może być dłuższy niż {{ limit }} znaków"
     * )
     */
    private $title;

    /**
     * @Assert\NotBlank(message="To pole nie może być puste")
     *        @Assert\Length(
     *      max = 10000,
     *      maxMessage = "Wyraz nie może być dłuższy niż {{ limit }} znaków"
     * )
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $addedAt;
    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $editedAt;

    /**
     * @Assert\NotBlank(message="To pole nie może być puste")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $salaryMin;

    /**
     * @Assert\NotBlank(message="To pole nie może być puste")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $salaryMax;



    /**
     * @Assert\NotBlank(message="To pole nie może być puste")
     * @ORM\Column(type="string", length=100)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Skill", mappedBy="offert",orphanRemoval=true ,cascade={"persist"})
     */
    private $skill;

    public function __construct()
    {
        $this->skill = new ArrayCollection();
        $this->addedAt = new \DateTime();
    }

   
    public function prePersist()
    {
        $this->editedAt = new \DateTime();
    }
    public function getId(): ?int
    {
        return $this->id;
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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmployerId()
    {
        return $this->employer_id;
    }

    /**
     * @param mixed $employer_id
     */
    public function setEmployerId($employer_id): void
    {
        $this->employer_id = $employer_id;
    }

    public function getAddedAt(): ?\DateTimeInterface
    {
        return $this->addedAt;
    }

    public function setAddedAt(\DateTimeInterface $addedAt): self
    {
        $this->addedAt = $addedAt;

        return $this;
    }
    public function getEditedAt(): ?\DateTimeInterface
    {
        return $this->editedAt;
    }

    public function setEditedAt(\DateTimeInterface $editedAt): self
    {
        $this->addedAt = $editedAt;

        return $this;
    }

    public function getSalaryMin(): ?int
    {
        return $this->salaryMin;
    }

    public function setSalaryMin(?int $salaryMin): self
    {
        $this->salaryMin = $salaryMin;

        return $this;
    }

    public function getSalaryMax(): ?int
    {
        return $this->salaryMax;
    }

    public function setSalaryMax(?int $salaryMax): self
    {
        $this->salaryMax = $salaryMax;

        return $this;
    }


    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Skill[]
     */
    public function getSkill(): Collection
    {
        return $this->skill;
    }

    public function addSkill(Skill $skill): self
    {
        if (!$this->skill->contains($skill)) {
            $this->skill[] = $skill;
            $skill->setOffert($this);
        }

        return $this;
    }

    public function removeSkill(Skill $skill): self
    {
        if ($this->skill->contains($skill)) {
            $this->skill->removeElement($skill);
            // set the owning side to null (unless already changed)
            if ($skill->getOffert() === $this) {
                $skill->setOffert(null);
            }
        }

        return $this;
    }
}
