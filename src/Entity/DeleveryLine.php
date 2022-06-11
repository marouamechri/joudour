<?php

namespace App\Entity;

use App\Repository\DeleveryLineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeleveryLineRepository::class)]
class DeleveryLine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $quantity;

    #[ORM\ManyToOne(targetEntity: Delivery::class, inversedBy: 'deleveryLines')]
    #[ORM\JoinColumn(nullable: false)]
    private $delevery;

    #[ORM\OneToOne(inversedBy: 'deleveryLine', targetEntity: OrderLine::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $order_line;

    #[ORM\OneToOne(mappedBy: 'deliveryLine', targetEntity: BillLine::class, cascade: ['persist', 'remove'])]
    private $billLine;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getDelevery(): ?Delivery
    {
        return $this->delevery;
    }

    public function setDelevery(?Delivery $delevery): self
    {
        $this->delevery = $delevery;

        return $this;
    }

    public function getOrderLine(): ?OrderLine
    {
        return $this->order_line;
    }

    public function setOrderLine(OrderLine $order_line): self
    {
        $this->order_line = $order_line;

        return $this;
    }

    public function getBillLine(): ?BillLine
    {
        return $this->billLine;
    }

    public function setBillLine(BillLine $billLine): self
    {
        // set the owning side of the relation if necessary
        if ($billLine->getDeliveryLine() !== $this) {
            $billLine->setDeliveryLine($this);
        }

        $this->billLine = $billLine;

        return $this;
    }
}
