<?php

namespace App\Entity;

use App\Repository\ColorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ColorRepository::class)]
class Color
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 7)]
    private $ref;

    #[ORM\OneToMany(mappedBy: 'color', targetEntity: ProductColor::class)]
    private $productColors;

    #[ORM\Column(type: 'string', length: 15)]
    private $nameColor;

    public function __construct()
    {
        $this->productColors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }
    public function getNameColor(): ?string
    {
        return $this->nameColor;
    }

    public function setNameColor(string $nameColor): self
    {
        $this->nameColor = $nameColor;

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
            $productColor->setColor($this);
        }

        return $this;
    }

    public function removeProductColor(ProductColor $productColor): self
    {
        if ($this->productColors->removeElement($productColor)) {
            // set the owning side to null (unless already changed)
            if ($productColor->getColor() === $this) {
                $productColor->setColor(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return '<p>'. $this->ref.'<p>';
    }
   
}
