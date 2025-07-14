<?php

namespace App\Entity;

use App\Repository\CartLineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartLineRepository::class)]
class CartLine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

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

    #[ORM\Column(type: 'float')]
    private $subToltalProductTTC;

    #[ORM\ManyToOne(targetEntity: Cart::class, inversedBy: 'cartLines')]
    #[ORM\JoinColumn(nullable: false)]
    private $cart;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSubToltalProductTTC(): ?float
    {
        return $this->subToltalProductTTC;
    }

    public function setSubToltalProductTTC(float $subToltalProductTTC): self
    {
        $this->subToltalProductTTC = $subToltalProductTTC;

        return $this;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): self
    {
        $this->cart = $cart;

        return $this;
    }
}
