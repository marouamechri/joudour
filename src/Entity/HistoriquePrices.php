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

    public function getId(): ?int
    {
        return $this->id;
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
}
