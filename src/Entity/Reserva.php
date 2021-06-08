<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ReservaRepository::class)
 */
class Reserva
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     *@Assert\NotBlank
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity=Campers::class, cascade={"persist", "remove"})
     *@Assert\NotBlank
     */
    private $campers;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservas")
     */
    private $User;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getCampers(): ?Campers
    {
        return $this->campers;
    }

    public function setCampers(?Campers $campers): self
    {
        $this->campers = $campers;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

}
