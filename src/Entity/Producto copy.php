<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductoRepository::class)]
class Producto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(nullable: true)]
    private ?float $precio = null;

    #[ORM\Column(nullable: true)]
    private ?int $iva = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fotos = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fotoportada = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $fichatecnica = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(?float $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getIva(): ?int
    {
        return $this->iva;
    }

    public function setIva(?int $iva): self
    {
        $this->iva = $iva;

        return $this;
    }

    public function getFotos(): ?string
    {
        return $this->fotos;
    }

    public function setFotos(?string $fotos): self
    {
        $this->fotos = $fotos;

        return $this;
    }

    public function getFotoportada(): ?string
    {
        return $this->fotoportada;
    }

    public function setFotoportada(?string $fotoportada): self
    {
        $this->fotoportada = $fotoportada;

        return $this;
    }

    public function getFichatecnica(): ?string
    {
        return $this->fichatecnica;
    }

    public function setFichatecnica(?string $fichatecnica): self
    {
        $this->fichatecnica = $fichatecnica;

        return $this;
    }
}
