<?php

namespace App\Entity;

use App\Repository\HosterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HosterRepository::class)]
class Hoster
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'hosters')]
    private ?Adress $adressHoster = null;

    #[ORM\OneToMany(mappedBy: 'hoster', targetEntity: Horse::class)]
    private Collection $horses;

    public function __construct()
    {
        $this->horses = new ArrayCollection();
    }

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

    public function getAdressHoster(): ?adress
    {
        return $this->adressHoster;
    }

    public function setAdressHoster(?adress $adressHoster): self
    {
        $this->adressHoster = $adressHoster;

        return $this;
    }

    /**
     * @return Collection<int, Horse>
     */
    public function getHorses(): Collection
    {
        return $this->horses;
    }

    public function addHorse(Horse $horse): self
    {
        if (!$this->horses->contains($horse)) {
            $this->horses->add($horse);
            $horse->setHoster($this);
        }

        return $this;
    }

    public function removeHorse(Horse $horse): self
    {
        if ($this->horses->removeElement($horse)) {
            // set the owning side to null (unless already changed)
            if ($horse->getHoster() === $this) {
                $horse->setHoster(null);
            }
        }

        return $this;
    }
}
