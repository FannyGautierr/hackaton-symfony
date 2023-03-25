<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'domaine', targetEntity: Station::class, orphanRemoval: true)]
    private Collection $stations;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $AdminRequest = null;
    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Station $station = null;

    #[ORM\OneToMany(mappedBy: 'user_id', targetEntity: CommPost::class, orphanRemoval: true)]
    private Collection $commPosts;

    public function __construct()
    {
        $this->stations = new ArrayCollection();
        $this->commPosts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Station>
     */
    public function getStations(): Collection
    {
        return $this->stations;
    }

    public function addStation(Station $station): self
    {
        if (!$this->stations->contains($station)) {
            $this->stations->add($station);
            $station->setDomaine($this);
        }

        return $this;
    }

    public function removeStation(Station $station): self
    {
        if ($this->stations->removeElement($station)) {
            // set the owning side to null (unless already changed)
            if ($station->getDomaine() === $this) {
                $station->setDomaine(null);
            }
        }

        return $this;
    }

    public function getAdminRequest(): ?string
    {
        return $this->AdminRequest;
    }

    public function setAdminRequest(?string $AdminRequest): self
    {
        $this->AdminRequest = $AdminRequest;

        return $this;
    }
    public function getStation(): ?Station
    {
        return $this->station;
    }

    public function setStation(?Station $station): self
    {
        // unset the owning side of the relation if necessary
        if ($station === null && $this->station !== null) {
            $this->station->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($station !== null && $station->getUser() !== $this) {
            $station->setUser($this);
        }

        $this->station = $station;

        return $this;
    }
    public function __toString()
    {
        return $this->email;
    }

    /**
     * @return Collection<int, CommPost>
     */
    public function getCommPosts(): Collection
    {
        return $this->commPosts;
    }

    public function addCommPost(CommPost $commPost): self
    {
        if (!$this->commPosts->contains($commPost)) {
            $this->commPosts->add($commPost);
            $commPost->setUserId($this);
        }

        return $this;
    }

    public function removeCommPost(CommPost $commPost): self
    {
        if ($this->commPosts->removeElement($commPost)) {
            // set the owning side to null (unless already changed)
            if ($commPost->getUserId() === $this) {
                $commPost->setUserId(null);
            }
        }

        return $this;
    }
}
