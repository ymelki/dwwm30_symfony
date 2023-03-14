<?php

namespace App\Entity;

use App\Repository\RcategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RcategorieRepository::class)]
class Rcategorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'categories', targetEntity: Rproduit::class)]
    private Collection $rproduits;

    #[ORM\OneToMany(mappedBy: 'categories', targetEntity: Annonce::class)]
    private Collection $annonces;

    public function __construct()
    {
        $this->rproduits = new ArrayCollection();
        $this->annonces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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

    public function __toString()
    {
        return  $this->titre;
    }

    /**
     * @return Collection<int, Rproduit>
     */
    public function getRproduits(): Collection
    {
        return $this->rproduits;
    }

    public function addRproduit(Rproduit $rproduit): self
    {
        if (!$this->rproduits->contains($rproduit)) {
            $this->rproduits->add($rproduit);
            $rproduit->setCategories($this);
        }

        return $this;
    }

    public function removeRproduit(Rproduit $rproduit): self
    {
        if ($this->rproduits->removeElement($rproduit)) {
            // set the owning side to null (unless already changed)
            if ($rproduit->getCategories() === $this) {
                $rproduit->setCategories(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Annonce>
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonce $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces->add($annonce);
            $annonce->setCategories($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getCategories() === $this) {
                $annonce->setCategories(null);
            }
        }

        return $this;
    }
}
