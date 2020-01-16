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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMovieID(): ?int
    {
        return $this->MovieID;
    }

    public function setMovieID(int $MovieID): self
    {
        $this->MovieID = $MovieID;

        return $this;
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

    public function getOwnerID(): ?int
    {
        return $this->OwnerID;
    }

    public function setOwnerID(int $OwnerID): self
    {
        $this->OwnerID = $OwnerID;

        return $this;
    }
}
