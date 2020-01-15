<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovieRepository")
 */
class Movie
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
    private $Pavadinimas;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $Isleidimo_data;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Ivercio_vidurkis;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Ivercio_kiekis;

    /**
     * @ORM\Column(type="time", nullable=true)
     */
    private $Trukme;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Pelnas;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Islaidos;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Pajamos;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Originalus_pavadinimas;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPavadinimas(): ?string
    {
        return $this->Pavadinimas;
    }

    public function setPavadinimas(string $Pavadinimas): self
    {
        $this->Pavadinimas = $Pavadinimas;

        return $this;
    }

    public function getIsleidimoData(): ?\DateTimeInterface
    {
        return $this->Isleidimo_data;
    }

    public function setIsleidimoData(?\DateTimeInterface $Isleidimo_data): self
    {
        $this->Isleidimo_data = $Isleidimo_data;

        return $this;
    }

    public function getIvercioVidurkis(): ?float
    {
        return $this->Ivercio_vidurkis;
    }

    public function setIvercioVidurkis(?float $Ivercio_vidurkis): self
    {
        $this->Ivercio_vidurkis = $Ivercio_vidurkis;

        return $this;
    }

    public function getIvercioKiekis(): ?int
    {
        return $this->Ivercio_kiekis;
    }

    public function setIvercioKiekis(?int $Ivercio_kiekis): self
    {
        $this->Ivercio_kiekis = $Ivercio_kiekis;

        return $this;
    }

    public function getTrukme(): ?\DateTimeInterface
    {
        return $this->Trukme;
    }

    public function setTrukme(?\DateTimeInterface $Trukme): self
    {
        $this->Trukme = $Trukme;

        return $this;
    }

    public function getPelnas(): ?float
    {
        return $this->Pelnas;
    }

    public function setPelnas(?float $Pelnas): self
    {
        $this->Pelnas = $Pelnas;

        return $this;
    }

    public function getIslaidos(): ?float
    {
        return $this->Islaidos;
    }

    public function setIslaidos(?float $Islaidos): self
    {
        $this->Islaidos = $Islaidos;

        return $this;
    }

    public function getPajamos(): ?float
    {
        return $this->Pajamos;
    }

    public function setPajamos(?float $Pajamos): self
    {
        $this->Pajamos = $Pajamos;

        return $this;
    }

    public function getOriginalusPavadinimas(): ?string
    {
        return $this->Originalus_pavadinimas;
    }

    public function setOriginalusPavadinimas(?string $Originalus_pavadinimas): self
    {
        $this->Originalus_pavadinimas = $Originalus_pavadinimas;

        return $this;
    }
}
