<?php

namespace App\Entity;

use App\Repository\InterventionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InterventionRepository::class)]
class Intervention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    private ?Horse $horse = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $startDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endDate = null;

    #[ORM\Column(length: 255)]
    private ?string $service = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $horseShoeSize = null;

    #[ORM\Column]
    private ?bool $done = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $pathologies = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $comments = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHorse(): ?horse
    {
        return $this->horse;
    }

    public function setHorse(?horse $horse): self
    {
        $this->horse = $horse;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getService(): ?string
    {
        return $this->service;
    }

    public function setService(string $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getHorseShoeSize(): ?string
    {
        return $this->horseShoeSize;
    }

    public function setHorseShoeSize(?string $horseShoeSize): self
    {
        $this->horseShoeSize = $horseShoeSize;

        return $this;
    }

    public function isDone(): ?bool
    {
        return $this->done;
    }

    public function setDone(bool $done): self
    {
        $this->done = $done;

        return $this;
    }

    public function getPathologies(): ?string
    {
        return $this->pathologies;
    }

    public function setPathologies(?string $pathologies): self
    {
        $this->pathologies = $pathologies;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }
}
