<?php

namespace App\Entity;

use App\Repository\CutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CutRepository::class)]
class Cut
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 5)]
    private $CutValue;

    #[ORM\OneToMany(mappedBy: 'cut', targetEntity: ProductColor::class)]
    private $productColors;

    #[ORM\OneToMany(mappedBy: 'cut', targetEntity: ProductCut::class)]
    private $productCuts;

    #[ORM\Column(type: 'boolean')]
    private $active;

    public function __construct()
    {
        $this->productColors = new ArrayCollection();
        $this->productCuts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCutValue(): ?string
    {
        return $this->CutValue;
    }

    public function setCutValue(string $CutValue): self
    {
        $this->CutValue = $CutValue;

        return $this;
    }

    /**
     * @return Collection<int, ProductColor>
     */
    public function getProductColors(): Collection
    {
        return $this->productColors;
    }

    public function addProductColor(ProductColor $productColor): self
    {
        if (!$this->productColors->contains($productColor)) {
            $this->productColors[] = $productColor;
            $productColor->setCut($this);
        }

        return $this;
    }

    public function removeProductColor(ProductColor $productColor): self
    {
        if ($this->productColors->removeElement($productColor)) {
            // set the owning side to null (unless already changed)
            if ($productColor->getCut() === $this) {
                $productColor->setCut(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProductCut>
     */
    public function getProductCuts(): Collection
    {
        return $this->productCuts;
    }

    public function addProductCut(ProductCut $productCut): self
    {
        if (!$this->productCuts->contains($productCut)) {
            $this->productCuts[] = $productCut;
            $productCut->setCut($this);
        }

        return $this;
    }

    public function removeProductCut(ProductCut $productCut): self
    {
        if ($this->productCuts->removeElement($productCut)) {
            // set the owning side to null (unless already changed)
            if ($productCut->getCut() === $this) {
                $productCut->setCut(null);
            }
        }

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }
}
