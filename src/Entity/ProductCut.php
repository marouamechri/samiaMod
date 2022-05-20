<?php

namespace App\Entity;

use App\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductCutRepository;

#[ORM\Entity(repositoryClass: ProductCutRepository::class)]
class ProductCut extends Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'productCut', targetEntity: Stock::class, cascade: ['persist', 'remove'])]
    private $stock;

    #[ORM\ManyToOne(targetEntity: Cut::class, inversedBy: 'productCuts')]
    #[ORM\JoinColumn(nullable: false)]
    private $cut;

    #[ORM\OneToMany(mappedBy: 'productCut', targetEntity: HistoriquePrices::class)]
    private $historiquePrices;

    public function __construct()
    {
        parent::__construct();
        $this->historiquePrices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStock(): ?Stock
    {
        return $this->stock;
    }

    public function setStock(?Stock $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getCut(): ?Cut
    {
        return $this->cut;
    }

    public function setCut(?Cut $cut): self
    {
        $this->cut = $cut;

        return $this;
    }

    /**
     * @return Collection<int, HistoriquePrices>
     */
    public function getHistoriquePrices(): Collection
    {
        return $this->historiquePrices;
    }

    public function addHistoriquePrice(HistoriquePrices $historiquePrice): self
    {
        if (!$this->historiquePrices->contains($historiquePrice)) {
            $this->historiquePrices[] = $historiquePrice;
            $historiquePrice->setProductCut($this);
        }

        return $this;
    }

    public function removeHistoriquePrice(HistoriquePrices $historiquePrice): self
    {
        if ($this->historiquePrices->removeElement($historiquePrice)) {
            // set the owning side to null (unless already changed)
            if ($historiquePrice->getProductCut() === $this) {
                $historiquePrice->setProductCut(null);
            }
        }

        return $this;
    }

}
