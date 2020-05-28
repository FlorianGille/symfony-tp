<?php

namespace App\Entity;

use App\Repository\ProduitsMagasinsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitsMagasinsRepository::class)
 */
class ProduitsMagasins
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity=Produit::class, inversedBy="produitsMagasins")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */
    private $produit;

    /**
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $stockQte;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity=Magasin::class, inversedBy="produitsMagasins")
     * @ORM\JoinColumn(nullable=false, referencedColumnName="id")
     */
    private $magasin;

    public function __construct()
    {
        $this->stockQte = 0;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getStockQte(): ?int
    {
        return $this->stockQte;
    }

    public function setStockQte(?int $stockQte): self
    {
        $this->stockQte = $stockQte;

        return $this;
    }

    public function getMagasin(): ?Magasin
    {
        return $this->magasin;
    }

    public function setMagasin(?Magasin $magasin): self
    {
        $this->magasin = $magasin;

        return $this;
    }
}
