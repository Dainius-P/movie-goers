<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WatchListRepository")
 */
class WatchList
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="watchList")
     */
    private $usr;
    
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="watchList")
     */
    private $movie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getUsr(): ?User
    {
        return $this->usr;
    }

    public function setUsr(?User $usr): self
    {
        $this->usr = $usr;

        return $this;
    }

    public function getMovie(): ?User
    {
        return $this->movie;
    }

    public function setMovie(?User $movie): self
    {
        $this->movie = $movie;

        return $this;
    }
}
