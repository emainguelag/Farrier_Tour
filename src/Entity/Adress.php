<?php

namespace App\Entity;

use App\Repository\AdressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdressRepository::class)]
class Adress
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstLine = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $secondLine = null;

    #[ORM\Column(length: 5)]
    private ?string $PostalCode = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $country = 'France';

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $latitude = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $longitude = null;

    #[ORM\OneToMany(mappedBy: 'adressFarrier', targetEntity: Farrier::class)]
    private Collection $farriers;

    #[ORM\OneToMany(mappedBy: 'adressCustomer', targetEntity: Customer::class)]
    private Collection $customers;

    #[ORM\OneToMany(mappedBy: 'adressHoster', targetEntity: Hoster::class)]
    private Collection $hosters;

    public function __construct()
    {
        $this->farriers = new ArrayCollection();
        $this->customers = new ArrayCollection();
        $this->hosters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstLine(): ?string
    {
        return $this->firstLine;
    }

    public function setFirstLine(string $firstLine): self
    {
        $this->firstLine = $firstLine;

        return $this;
    }

    public function getSecondLine(): ?string
    {
        return $this->secondLine;
    }

    public function setSecondLine(?string $secondLine): self
    {
        $this->secondLine = $secondLine;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->PostalCode;
    }

    public function setPostalCode(string $PostalCode): self
    {
        $this->PostalCode = $PostalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return Collection<int, Farrier>
     */
    public function getFarriers(): Collection
    {
        return $this->farriers;
    }

    public function addFarrier(Farrier $farrier): self
    {
        if (!$this->farriers->contains($farrier)) {
            $this->farriers->add($farrier);
            $farrier->setAdress($this);
        }

        return $this;
    }

    public function removeFarrier(Farrier $farrier): self
    {
        if ($this->farriers->removeElement($farrier)) {
            // set the owning side to null (unless already changed)
            if ($farrier->getAdress() === $this) {
                $farrier->setAdress(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Customer>
     */
    public function getCustomers(): Collection
    {
        return $this->customers;
    }

    public function addCustomer(Customer $customer): self
    {
        if (!$this->customers->contains($customer)) {
            $this->customers->add($customer);
            $customer->setAdress($this);
        }

        return $this;
    }

    public function removeCustomer(Customer $customer): self
    {
        if ($this->customers->removeElement($customer)) {
            // set the owning side to null (unless already changed)
            if ($customer->getAdress() === $this) {
                $customer->setAdress(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Hoster>
     */
    public function getHosters(): Collection
    {
        return $this->hosters;
    }

    public function addHoster(Hoster $hoster): self
    {
        if (!$this->hosters->contains($hoster)) {
            $this->hosters->add($hoster);
            $hoster->setAdress($this);
        }

        return $this;
    }

    public function removeHoster(Hoster $hoster): self
    {
        if ($this->hosters->removeElement($hoster)) {
            // set the owning side to null (unless already changed)
            if ($hoster->getAdress() === $this) {
                $hoster->setAdress(null);
            }
        }

        return $this;
    }
}
