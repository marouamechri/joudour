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
    private $start_date_prices_sale_htva;

    #[ORM\Column(type: 'datetime')]
    private $endDatePricesSaleHTVA;

    #[ORM\Column(type: 'float')]
    private $amountHTVA;

    #[ORM\ManyToOne(targetEntity: ProductCut::class, inversedBy: 'historiquePrices')]
    #[ORM\JoinColumn(nullable: false)]
    private $ProductCut;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDatePricesSaleHtva(): ?\DateTimeInterface
    {
        return $this->start_date_prices_sale_htva;
    }

    public function setStartDatePricesSaleHtva(\DateTimeInterface $start_date_prices_sale_htva): self
    {
        $this->start_date_prices_sale_htva = $start_date_prices_sale_htva;

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
        return $this->ProductCut;
    }

    public function setProductCut(?ProductCut $ProductCut): self
    {
        $this->ProductCut = $ProductCut;

        return $this;
    }
}
