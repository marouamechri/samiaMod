<?php

namespace App\Entity;

use App\Repository\HistoriquePricesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoriquePricesRepository::class)]
class HistoriquePrices
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $startPricesSaleHTVA;

    #[ORM\Column(type: 'date')]
    private $endDatePricesSale;

    #[ORM\Column(type: 'float')]
    private $amountHTVA;

    #[ORM\ManyToOne(targetEntity: ProductCut::class, inversedBy: 'historiquePrices')]
    private $productCut;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartPricesSaleHTVA(): ?\DateTimeInterface
    {
        return $this->startPricesSaleHTVA;
    }

    public function setStartPricesSaleHTVA(\DateTimeInterface $startPricesSaleHTVA): self
    {
        $this->startPricesSaleHTVA = $startPricesSaleHTVA;

        return $this;
    }

    public function getEndDatePricesSale(): ?\DateTimeInterface
    {
        return $this->endDatePricesSale;
    }

    public function setEndDatePricesSale(\DateTimeInterface $endDatePricesSale): self
    {
        $this->endDatePricesSale = $endDatePricesSale;

        return $this;
    }

    public function getAmountHTVA(): ?float
    {
        return $this->amountHTVA;
    }

    public function setAmountHTVA(float $amountHTVA): self
    {
        $this->amountHTVA = $amountHTVA;

        return $this;
    }

    public function getProductCut(): ?ProductCut
    {
        return $this->productCut;
    }

    public function setProductCut(?ProductCut $productCut): self
    {
        $this->productCut = $productCut;

        return $this;
    }

   
}
