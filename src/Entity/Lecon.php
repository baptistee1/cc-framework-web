<?php

namespace App\Entity;

use App\Repository\LeconRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LeconRepository::class)]
class Lecon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Description = null;

    #[ORM\ManyToOne(inversedBy: 'leconsCreateur')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $createur = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'inscriptionsLecons')]
    private Collection $inscrits;

    public function __construct()
    {
        $this->inscrits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getCreateur(): ?User
    {
        return $this->createur;
    }

    public function setCreateur(?User $createur): static
    {
        $this->createur = $createur;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getInscrits(): Collection
    {
        return $this->inscrits;
    }

    public function addInscrit(User $inscrit): static
    {
        if (!$this->inscrits->contains($inscrit)) {
            $this->inscrits->add($inscrit);
            $inscrit->addInscriptionsLecon($this);
        }

        return $this;
    }

    public function removeInscrit(User $inscrit): static
    {
        if ($this->inscrits->removeElement($inscrit)) {
            $inscrit->removeInscriptionsLecon($this);
        }

        return $this;
    }
}
