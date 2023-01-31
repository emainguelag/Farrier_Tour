<?php

namespace App\Entity;

use App\Repository\FarrierRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FarrierRepository::class)]
class Farrier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $role = null;

    #[ORM\ManyToOne(inversedBy: 'farriers')]
    private ?Adress $adressFarrier = null;

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

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getAdressFarrier(): ?Adress
    {
        return $this->adressFarrier;
    }

    public function setAdressFarrier(?Adress $adressFarrier): self
    {
        $this->adressFarrier = $adressFarrier;

        return $this;
    }
}
