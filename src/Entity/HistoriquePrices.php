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

    #[ORM\Column(type: 'datetime')]
    private $startDatePricesSaleHTVA;

    #[ORM\Column(type: 'float')]
    private $amountHTVA;

    #[ORM\ManyToOne(targetEntity: ProductCut::class, inversedBy: 'historiquePrices')]
    #[ORM\JoinColumn(nullable: false)]
    private $productCut;

    #[ORM\Column(type: 'datetime')]
    private $endDatePricesSaleHTVA;

    #[ORM\Column(type: 'boolean')]
    private $active;

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * Get the value of startDatePricesSaleHTVA
     */ 
    public function getStartDatePricesSaleHTVA()
    {
        return $this->startDatePricesSaleHTVA;
    }

    /**
     * Set the value of startDatePricesSaleHTVA
     *
     * @return  self
     */ 
    public function setStartDatePricesSaleHTVA($startDatePricesSaleHTVA)
    {
        $this->startDatePricesSaleHTVA = $startDatePricesSaleHTVA;

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

    public function getEndDatePricesSaleHTVA(): ?\DateTimeInterface
    {
        return $this->endDatePricesSaleHTVA;
    }

    public function setEndDatePricesSaleHTVA(\DateTimeInterface $endDatePricesSaleHTVA): self
    {
        $this->endDatePricesSaleHTVA = $endDatePricesSaleHTVA;

        return $this;
    }
    public function __toString()
    {
        return $this->id;
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
