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
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(targetEntity: Lecon::class, mappedBy: 'createur', orphanRemoval: true)]
    private Collection $leconsCreateur;

    #[ORM\ManyToMany(targetEntity: Lecon::class, inversedBy: 'inscrits')]
    private Collection $inscriptionsLecons;

    public function __construct()
    {
        $this->leconsCreateur = new ArrayCollection();
        $this->inscriptionsLecons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
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

    public function setRoles(array $roles): static
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

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Lecon>
     */
    public function getLeconsCreateur(): Collection
    {
        return $this->leconsCreateur;
    }

    public function addLeconsCreateur(Lecon $leconsCreateur): static
    {
        if (!$this->leconsCreateur->contains($leconsCreateur)) {
            $this->leconsCreateur->add($leconsCreateur);
            $leconsCreateur->setCreateur($this);
        }

        return $this;
    }

    public function removeLeconsCreateur(Lecon $leconsCreateur): static
    {
        if ($this->leconsCreateur->removeElement($leconsCreateur)) {
            // set the owning side to null (unless already changed)
            if ($leconsCreateur->getCreateur() === $this) {
                $leconsCreateur->setCreateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Lecon>
     */
    public function getInscriptionsLecons(): Collection
    {
        return $this->inscriptionsLecons;
    }

    public function addInscriptionsLecon(Lecon $inscriptionsLecon): static
    {
        if (!$this->inscriptionsLecons->contains($inscriptionsLecon)) {
            $this->inscriptionsLecons->add($inscriptionsLecon);
        }

        return $this;
    }

    public function removeInscriptionsLecon(Lecon $inscriptionsLecon): static
    {
        $this->inscriptionsLecons->removeElement($inscriptionsLecon);

        return $this;
    }
}
