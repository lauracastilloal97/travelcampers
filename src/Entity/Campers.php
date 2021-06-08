<?php

namespace App\Entity;

use App\Repository\CampersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CampersRepository::class)
 */
class Campers
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
    private $matricula;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank
     */
    private $marca;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank
     */
    private $modelo;

    /**
     * @ORM\Column(type="integer")
     *@Assert\NotBlank
     */
    private $precio;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank
     */
    private $descripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255)
     *@Assert\NotBlank
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=Comentario::class, mappedBy="camper")
     */
    private $comentarios;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dimensiones;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $capacidad;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $wc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $camas;

    public function __construct()
    {
        $this->comentarios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricula(): ?string
    {
        return $this->matricula;
    }

    public function setMatricula(string $matricula): self
    {
        $this->matricula = $matricula;

        return $this;
    }

    public function getMarca(): ?string
    {
        return $this->marca;
    }

    public function setMarca(string $marca): self
    {
        $this->marca = $marca;

        return $this;
    }

    public function getModelo(): ?string
    {
        return $this->modelo;
    }

    public function setModelo(string $modelo): self
    {
        $this->modelo = $modelo;

        return $this;
    }

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(int $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
    
        public function __toString(){

        return $this ->title;
    }

        /**
         * @return Collection|Comentario[]
         */
        public function getComentarios(): Collection
        {
            return $this->comentarios;
        }

        public function addComentario(Comentario $comentario): self
        {
            if (!$this->comentarios->contains($comentario)) {
                $this->comentarios[] = $comentario;
                $comentario->setCamper($this);
            }

            return $this;
        }

        public function removeComentario(Comentario $comentario): self
        {
            if ($this->comentarios->removeElement($comentario)) {
                // set the owning side to null (unless already changed)
                if ($comentario->getCamper() === $this) {
                    $comentario->setCamper(null);
                }
            }

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

        public function getDimensiones(): ?string
        {
            return $this->dimensiones;
        }

        public function setDimensiones(?string $dimensiones): self
        {
            $this->dimensiones = $dimensiones;

            return $this;
        }

        public function getCapacidad(): ?string
        {
            return $this->capacidad;
        }

        public function setCapacidad(?string $capacidad): self
        {
            $this->capacidad = $capacidad;

            return $this;
        }

        public function getWc(): ?string
        {
            return $this->wc;
        }

        public function setWc(?string $wc): self
        {
            $this->wc = $wc;

            return $this;
        }

        public function getCamas(): ?string
        {
            return $this->camas;
        }

        public function setCamas(?string $camas): self
        {
            $this->camas = $camas;

            return $this;
        }

}
