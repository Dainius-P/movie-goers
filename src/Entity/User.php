<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $Pass;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
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
    private $WatcListSize;

    /**
     * @ORM\Column(type="integer")
     */
    private $Role;

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

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getPass(): ?string
    {
        return $this->Pass;
    }

    public function setPass(string $Pass): self
    {
        $this->Pass = $Pass;

        return $this;
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

    public function getWatcListSize(): ?int
    {
        return $this->WatcListSize;
    }

    public function setWatcListSize(int $WatcListSize): self
    {
        $this->WatcListSize = $WatcListSize;

        return $this;
    }

    public function getRole(): ?int
    {
        return $this->Role;
    }

    public function setRole(int $Role): self
    {
        $this->Role = $Role;

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
