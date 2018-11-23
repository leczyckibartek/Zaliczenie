<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CvMainRepository")
 */
class CvMain
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $fname;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $lname;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $sex;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $address;

    /**
     * @ORM\Column(type="string")
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=9)
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Expirience", mappedBy="cv", cascade={"persist"})
     */
    private $expiriences;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\School", mappedBy="cv", cascade={"persist"})
     */
    private $schools;

    /**
     * @ORM\Column(type="integer")
     */
    private $userid;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SkillCv", mappedBy="cv", cascade={"persist"})
     */
    private $skillCvs;

    public function __construct()
    {
        $this->expiriences = new ArrayCollection();
        $this->schools = new ArrayCollection();
        $this->skillCvs = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFname(): ?string
    {
        return $this->fname;
    }

    public function setFname(string $fname): self
    {
        $this->fname = $fname;

        return $this;
    }

    public function getLname(): ?string
    {
        return $this->lname;
    }

    public function setLname(string $lname): self
    {
        $this->lname = $lname;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return Collection|Expirience[]
     */
    public function getExpiriences(): Collection
    {
        return $this->expiriences;
    }

    public function addExpirience(Expirience $expirience): self
    {
        if (!$this->expiriences->contains($expirience)) {
            $this->expiriences[] = $expirience;
            $expirience->setCv($this);
        }

        return $this;
    }

    public function removeExpirience(Expirience $expirience): self
    {
        if ($this->expiriences->contains($expirience)) {
            $this->expiriences->removeElement($expirience);
            // set the owning side to null (unless already changed)
            if ($expirience->getCv() === $this) {
                $expirience->setCv(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|School[]
     */
    public function getSchools(): Collection
    {
        return $this->schools;
    }

    public function addSchool(School $school): self
    {
        if (!$this->schools->contains($school)) {
            $this->schools[] = $school;
            $school->setCv($this);
        }

        return $this;
    }

    public function removeSchool(School $school): self
    {
        if ($this->schools->contains($school)) {
            $this->schools->removeElement($school);
            // set the owning side to null (unless already changed)
            if ($school->getCv() === $this) {
                $school->setCv(null);
            }
        }

        return $this;
    }

    public function getUserid(): ?int
    {
        return $this->userid;
    }

    public function setUserid(int $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * @return Collection|SkillCv[]
     */
    public function getSkillCvs(): Collection
    {
        return $this->skillCvs;
    }

    public function addSkillCv(SkillCv $skillCv): self
    {
        if (!$this->skillCvs->contains($skillCv)) {
            $this->skillCvs[] = $skillCv;
            $skillCv->setCv($this);
        }

        return $this;
    }

    public function removeSkillCv(SkillCv $skillCv): self
    {
        if ($this->skillCvs->contains($skillCv)) {
            $this->skillCvs->removeElement($skillCv);
            // set the owning side to null (unless already changed)
            if ($skillCv->getCv() === $this) {
                $skillCv->setCv(null);
            }
        }

        return $this;
    }
}
