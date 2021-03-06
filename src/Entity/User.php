<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
 */
class User implements UserInterface
{


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="To pole nie może być puste")
     *      @Assert\Length(
     *      max = 30,
     *      maxMessage = "Wyraz nie może być dłuższy niż {{ limit }} znaków"
     * )
     * @ORM\Column(type="string", length=30, unique=true)
     * @Assert\Email(
     *     message = "Ten email '{{ value }}' nie jest poprwany ",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     * @Assert\NotBlank(message="To pole nie może być puste")
     *       @Assert\Length(
     *      max = 50,
     *      maxMessage = "Wyraz nie może być dłuższy niż {{ limit }} znaków"
     * )
     */
    private $username;


    private $plainPassword;

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *     @Assert\Length(
     *      max = 64,
     *      maxMessage = "Hasło może mieć maksymalnie {{ limit }} znaków"
     * )
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $CEIDG;

    /**
     * @ORM\Column(type="string",length=50, nullable=true)
     */
    private $avatar;



    public function __construct()
    {
        $this->roles = array('ROLE_USER');
        $this->date = new \DateTime();
    }

    // other properties and methods


    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getSalt()
    {
        // The bcrypt and argon2i algorithms don't require a separate salt.
        // You *may* need a real salt if you choose a different encoder.
        return null;
    }

    public function getRoles()
    {
        return $this->roles;
    }
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

    public function eraseCredentials()
    {
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

    public function getCEIDG(): ?string
    {
        return $this->CEIDG;
    }

    public function setCEIDG(?string $CEIDG): self
    {
        $this->CEIDG = $CEIDG;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
}
