<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @Gedmo\Slug(fields={"titre","dateCreation"}, updatable=false, dateFormat="d/m/Y", unique=true)
     * @ORM\Column(type="string", length=128, unique=true, nullable=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $prixTTC;

    /**
     * @ORM\Column(type="float")
     */
    private $poids;

    /**
     * @ORM\Column(type="integer")
     */
    private $couleur;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min="3",max="100", notInRangeMessage="Attentoin il faut ça soit entre {{ min }} et {{ max }} et vous avez selectionner {{ value }}")
     */
    private $stockQte;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $actif;

    /**
     * @ORM\ManyToOne(targetEntity=Marque::class, inversedBy="produit")
     */
    private $marque;

    /**
     * @ORM\OneToMany(targetEntity=ProduitsMagasins::class, mappedBy="produit", orphanRemoval=true)
     */
    private $produitsMagasins;

    public function __construct()
    {
        $this->actif = false;
        $this->dateCreation = new \DateTime();
        $this->produitsMagasins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return Produit
     */
    public function setSlug(string $slug): Produit
    {
        $this->slug = $slug;
        return $this;
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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrixTTC(): ?float
    {
        return $this->prixTTC;
    }

    public function setPrixTTC(float $prixTTC): self
    {
        $this->prixTTC = $prixTTC;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->poids;
    }

    public function setPoids(float $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getCouleur(): ?int
    {
        return $this->couleur;
    }

    public function setCouleur(int $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getStockQte(): ?int
    {
        return $this->stockQte;
    }

    public function setStockQte(int $stockQte): self
    {
        $this->stockQte = $stockQte;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

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
            $produitsMagasin->setProduit($this);
        }

        return $this;
    }

    public function removeProduitsMagasin(ProduitsMagasins $produitsMagasin): self
    {
        if ($this->produitsMagasins->contains($produitsMagasin)) {
            $this->produitsMagasins->removeElement($produitsMagasin);
            // set the owning side to null (unless already changed)
            if ($produitsMagasin->getProduit() === $this) {
                $produitsMagasin->setProduit(null);
            }
        }

        return $this;
    }
}
