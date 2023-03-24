<?php

namespace App\Entity;

use App\Repository\SkiTrackRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SkiTrackRepository::class)]
class SkiTrack
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'skiTracks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Station $Station = null;

    #[ORM\Column(length: 255)]
    private ?string $difficulty = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $open = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $close = null;

    #[ORM\Column]
    private ?bool $exception = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $information = null;

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

    public function getStation(): ?Station
    {
        return $this->Station;
    }

    public function setStation(?Station $Station): self
    {
        $this->Station = $Station;

        return $this;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getOpen(): ?\DateTimeInterface
    {
        return $this->open;
    }

    public function setOpen(\DateTimeInterface $open): self
    {
        $this->open = $open;

        return $this;
    }

    public function getClose(): ?\DateTimeInterface
    {
        return $this->close;
    }

    public function setClose(\DateTimeInterface $close): self
    {
        $this->close = $close;

        return $this;
    }

    public function isException(): ?bool
    {
        return $this->exception;
    }

    public function setException(bool $exception): self
    {
        $this->exception = $exception;

        return $this;
    }

    public function getInformation(): ?string
    {
        return $this->information;
    }

    public function setInformation(string $information): self
    {
        $this->information = $information;

        return $this;
    }

    public function __toString()
    {
        return $this->open->format('H:i') . ' - ' . $this->close->format('H:i') . ' ' ;
    }
}
