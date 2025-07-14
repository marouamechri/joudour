<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StockRepository::class)]
class Stock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $stockMin;

    #[ORM\Column(type: 'integer')]
    private $stockMax;

    #[ORM\Column(type: 'integer')]
    private $nbrProduct;

    #[ORM\OneToOne(mappedBy: 'stock', targetEntity: ProductCut::class)]
    private $productCut;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStockMin(): ?int
    {
        return $this->stockMin;
    }

    public function setStockMin(int $stockMin): self
    {
        $this->stockMin = $stockMin;

        return $this;
    }

    public function getStockMax(): ?int
    {
        return $this->stockMax;
    }

    public function setStockMax(int $stockMax): self
    {
        $this->stockMax = $stockMax;

        return $this;
    }

    public function getNbrProduct(): ?int
    {
        return $this->nbrProduct;
    }

    public function setNbrProduct(int $nbrProduct): self
    {
        $this->nbrProduct = $nbrProduct;

        return $this;
    }

    public function getProductCut(): ?ProductCut
    {
        return $this->productCut;
    }

    public function setProductCut(ProductCut $productCut): self
    {
        // set the owning side of the relation if necessary
        if ($productCut->getStock() !== $this) {
            $productCut->setStock($this);
        }

        $this->productCut = $productCut;

        return $this;
    }
    public function __toString()
    {
        return '';
    }
}
