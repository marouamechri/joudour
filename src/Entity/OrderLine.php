<?php

namespace App\Entity;

use App\Repository\OrderLineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderLineRepository::class)]
class OrderLine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $quantity;

    #[ORM\ManyToOne(targetEntity: Order::class, inversedBy: 'orderLines')]
    #[ORM\JoinColumn(nullable: false)]
    private $idorder;

    #[ORM\ManyToOne(targetEntity: ProductCut::class, inversedBy: 'orderLines')]
    #[ORM\JoinColumn(nullable: false)]
    private $productCut;

    #[ORM\OneToOne(mappedBy: 'order_line', targetEntity: DeleveryLine::class, cascade: ['persist', 'remove'])]
    private $deleveryLine;

    #[ORM\Column(type: 'string', length: 255)]
    private $productName;

    #[ORM\Column(type: 'float')]
    private $productPrice;

    #[ORM\Column(type: 'integer')]
    private $productQuantity;

    #[ORM\Column(type: 'float')]
    private $subTotalProductHt;

    #[ORM\Column(type: 'float')]
    private $taxeProduct;

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

    public function getIdorder(): ?Order
    {
        return $this->idorder;
    }

    public function setIdorder(?Order $idorder): self
    {
        $this->idorder = $idorder;

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

    public function getDeleveryLine(): ?DeleveryLine
    {
        return $this->deleveryLine;
    }

    public function setDeleveryLine(DeleveryLine $deleveryLine): self
    {
        // set the owning side of the relation if necessary
        if ($deleveryLine->getOrderLine() !== $this) {
            $deleveryLine->setOrderLine($this);
        }

        $this->deleveryLine = $deleveryLine;

        return $this;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    public function getProductPrice(): ?float
    {
        return $this->productPrice;
    }

    public function setProductPrice(float $productPrice): self
    {
        $this->productPrice = $productPrice;

        return $this;
    }

    public function getProductQuantity(): ?int
    {
        return $this->productQuantity;
    }

    public function setProductQuantity(int $productQuantity): self
    {
        $this->productQuantity = $productQuantity;

        return $this;
    }

    public function getSubTotalProductHt(): ?float
    {
        return $this->subTotalProductHt;
    }

    public function setSubTotalProductHt(float $subTotalProductHt): self
    {
        $this->subTotalProductHt = $subTotalProductHt;

        return $this;
    }

    public function getTaxeProduct(): ?float
    {
        return $this->taxeProduct;
    }

    public function setTaxeProduct(float $taxeProduct): self
    {
        $this->taxeProduct = $taxeProduct;

        return $this;
    }
}
