<?php

namespace App\Entity;

use App\Repository\MagasinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MagasinRepository::class)
 */
class Magasin
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=ProduitsMagasins::class, mappedBy="magasin", orphanRemoval=true)
     */
    private $produitsMagasins;

    public function __construct()
    {
        $this->produitsMagasins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|ProduitsMagasins[]
     */
    public function getProduitsMagasins(): Collection
    {
        return $this->produitsMagasins;
    }

    public function addProduitsMagasin(ProduitsMagasins $produitsMagasin): self
    {
        if (!$this->produitsMagasins->contains($produitsMagasin)) {
            $this->produitsMagasins[] = $produitsMagasin;
            $produitsMagasin->setMagasin($this);
        }

        return $this;
    }

    public function removeProduitsMagasin(ProduitsMagasins $produitsMagasin): self
    {
        if ($this->produitsMagasins->contains($produitsMagasin)) {
            $this->produitsMagasins->removeElement($produitsMagasin);
            // set the owning side to null (unless already changed)
            if ($produitsMagasin->getMagasin() === $this) {
                $produitsMagasin->setMagasin(null);
            }
        }

        return $this;
    }
}
