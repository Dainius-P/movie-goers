<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 * 
 * @ORM\Table(name="user")
 * 
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Image;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SecurityQuestion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SecurityAnswer;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $Phone;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $Birthday;

    /**
     * @ORM\Column(type="integer")
     */
    private $WatchListSize;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="integer")
     */
    private $MoviesSeenCount;

    /**
     * @ORM\Column(type="integer")
     */
    private $ComentCount;

    /**
     * @ORM\Column(type="integer")
     */
    private $RatingCount;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(?string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getSecurityQuestion(): ?string
    {
        return $this->SecurityQuestion;
    }

    public function setSecurityQuestion(string $SecurityQuestion): self
    {
        $this->SecurityQuestion = $SecurityQuestion;

        return $this;
    }

    public function getSecurityAnswer(): ?string
    {
        return $this->SecurityAnswer;
    }

    public function setSecurityAnswer(string $SecurityAnswer): self
    {
        $this->SecurityAnswer = $SecurityAnswer;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(?string $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->Birthday;
    }

    public function setBirthday(?\DateTimeInterface $Birthday): self
    {
        $this->Birthday = $Birthday;

        return $this;
    }

    public function getWatchListSize(): ?int
    {
        return $this->WatchListSize;
    }

    public function setWatchListSize(int $WatchListSize): self
    {
        $this->WatchListSize = $WatchListSize;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getMoviesSeenCount(): ?int
    {
        return $this->MoviesSeenCount;
    }

    public function setMoviesSeenCount(int $MoviesSeenCount): self
    {
        $this->MoviesSeenCount = $MoviesSeenCount;

        return $this;
    }

    public function getComentCount(): ?int
    {
        return $this->ComentCount;
    }

    public function setComentCount(int $ComentCount): self
    {
        $this->ComentCount = $ComentCount;

        return $this;
    }

    public function getRatingCount(): ?int
    {
        return $this->RatingCount;
    }

    public function setRatingCount(int $RatingCount): self
    {
        $this->RatingCount = $RatingCount;

        return $this;
    }
}
