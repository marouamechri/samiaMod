<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 10)]
    private $refProduct;

    #[ORM\Column(type: 'string', length: 50)]
    private $nameProduct;

    #[ORM\Column(type: 'text')]
    private $descriptionProduct;

    #[ORM\Column(type: 'float')]
    private $pricesHTVA;

    #[ORM\Column(type: 'boolean')]
    private $lease;

    #[ORM\Column(type: 'boolean')]
    private $sale;


    #[ORM\OneToMany(mappedBy: 'product', targetEntity: ProductColor::class)]
    private $productColors;

    #[ORM\ManyToOne(targetEntity: Option::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private $type;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $UpdateAt;


    public function __construct()
    {
        $this->productColors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefProduct(): ?string
    {
        return $this->refProduct;
    }

    public function setRefProduct(string $refProduct): self
    {
        $this->refProduct = $refProduct;

        return $this;
    }

    public function getNameProduct(): ?string
    {
        return $this->nameProduct;
    }

    public function setNameProduct(string $nameProduct): self
    {
        $this->nameProduct = $nameProduct;

        return $this;
    }

    public function getDescriptionProduct(): ?string
    {
        return $this->descriptionProduct;
    }

    public function setDescriptionProduct(string $descriptionProduct): self
    {
        $this->descriptionProduct = $descriptionProduct;

        return $this;
    }

    public function getPricesHTVA(): ?float
    {
        return $this->pricesHTVA;
    }

    public function setPricesHTVA(float $pricesHTVA): self
    {
        $this->pricesHTVA = $pricesHTVA;

        return $this;
    }
    
    public function isLease(): ?bool
    {
        return $this->lease;
    }

    public function setLease(bool $lease): self
    {
        $this->lease = $lease;

        return $this;
    }

    public function isSale(): ?bool
    {
        return $this->sale;
    }

    public function setSale(bool $sale): self
    {
        $this->sale = $sale;

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
            $productColor->setProduct($this);
        }

        return $this;
    }

    public function removeProductColor(ProductColor $productColor): self
    {
        if ($this->productColors->removeElement($productColor)) {
            // set the owning side to null (unless already changed)
            if ($productColor->getProduct() === $this) {
                $productColor->setProduct(null);
            }
        }

        return $this;
    }

    public function getType(): ?Option
    {
        return $this->type;
    }

    public function setType(?Option $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->UpdateAt;
    }

    public function setUpdateAt(?\DateTimeInterface $UpdateAt): self
    {
        $this->UpdateAt = $UpdateAt;

        return $this;
    }

    
}
