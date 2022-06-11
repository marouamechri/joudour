<?php

namespace App\Entity;

use App\Repository\BillLineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BillLineRepository::class)]
class BillLine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'billLine', targetEntity: DeleveryLine::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $deliveryLine;

    #[ORM\ManyToOne(targetEntity: Bill::class, inversedBy: 'billLines')]
    #[ORM\JoinColumn(nullable: false)]
    private $bill;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeliveryLine(): ?DeleveryLine
    {
        return $this->deliveryLine;
    }

    public function setDeliveryLine(DeleveryLine $deliveryLine): self
    {
        $this->deliveryLine = $deliveryLine;

        return $this;
    }

    public function getBill(): ?Bill
    {
        return $this->bill;
    }

    public function setBill(?Bill $bill): self
    {
        $this->bill = $bill;

        return $this;
    }
}
