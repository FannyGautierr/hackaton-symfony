<?php

namespace App\Entity;

use App\Repository\SkiLiftRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SkiLiftRepository::class)]
class SkiLift
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $open = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $close = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $information = null;

    #[ORM\ManyToOne(inversedBy: 'skiLifts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Station $station = null;

    #[ORM\OneToMany(mappedBy: 'skiLift', targetEntity: SkiTrack::class)]
    private Collection $skiTracks;

    public function __construct()
    {
        $this->skiTracks = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

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

    public function getInformation(): ?string
    {
        return $this->information;
    }

    public function setInformation(?string $information): self
    {
        $this->information = $information;

        return $this;
    }

    public function getStation(): ?Station
    {
        return $this->station;
    }

    public function setStation(?Station $station): self
    {
        $this->station = $station;

        return $this;
    }

    /**
     * @return Collection<int, SkiTrack>
     */
    public function getSkiTracks(): Collection
    {
        return $this->skiTracks;
    }

    public function addSkiTrack(SkiTrack $skiTrack): self
    {
        if (!$this->skiTracks->contains($skiTrack)) {
            $this->skiTracks->add($skiTrack);
            $skiTrack->setSkiLift($this);
        }

        return $this;
    }

    public function removeSkiTrack(SkiTrack $skiTrack): self
    {
        if ($this->skiTracks->removeElement($skiTrack)) {
            // set the owning side to null (unless already changed)
            if ($skiTrack->getSkiLift() === $this) {
                $skiTrack->setSkiLift(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->name;
    }
}
