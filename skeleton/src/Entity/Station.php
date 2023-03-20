<?php

namespace App\Entity;

use App\Repository\StationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StationRepository::class)]
class Station
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[ORM\ManyToOne(inversedBy: 'stations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Domain $domaine = null;

    #[ORM\OneToMany(mappedBy: 'Station', targetEntity: SkiTrack::class, orphanRemoval: true)]
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getDomaine(): ?User
    {
        return $this->domaine;
    }

    public function setDomaine(?User $domaine): self
    {
        $this->domaine = $domaine;

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
            $skiTrack->setStation($this);
        }

        return $this;
    }

    public function removeSkiTrack(SkiTrack $skiTrack): self
    {
        if ($this->skiTracks->removeElement($skiTrack)) {
            // set the owning side to null (unless already changed)
            if ($skiTrack->getStation() === $this) {
                $skiTrack->setStation(null);
            }
        }

        return $this;
    }
}
