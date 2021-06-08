<?php

namespace App\Entity;

use App\Repository\RuteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=RuteRepository::class)
 */
class Rute
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $visitar;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dias;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $km;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tiempo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $parada;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $restaurante;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $camping;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getVisitar(): ?string
    {
        return $this->visitar;
    }

    public function setVisitar(?string $visitar): self
    {
        $this->visitar = $visitar;

        return $this;
    }

    public function getDias(): ?int
    {
        return $this->dias;
    }

    public function setDias(?int $dias): self
    {
        $this->dias = $dias;

        return $this;
    }

    public function getKm(): ?string
    {
        return $this->km;
    }

    public function setKm(?string $km): self
    {
        $this->km = $km;

        return $this;
    }

    public function getTiempo(): ?string
    {
        return $this->tiempo;
    }

    public function setTiempo(?string $tiempo): self
    {
        $this->tiempo = $tiempo;

        return $this;
    }

    public function getParada(): ?string
    {
        return $this->parada;
    }

    public function setParada(?string $parada): self
    {
        $this->parada = $parada;

        return $this;
    }

    public function getRestaurante(): ?string
    {
        return $this->restaurante;
    }

    public function setRestaurante(?string $restaurante): self
    {
        $this->restaurante = $restaurante;

        return $this;
    }

    public function getCamping(): ?string
    {
        return $this->camping;
    }

    public function setCamping(?string $camping): self
    {
        $this->camping = $camping;

        return $this;
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
}
