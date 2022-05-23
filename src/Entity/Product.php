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

    #[ORM\Column(type: 'string', length: 20)]
    private $nameProduct;

    #[ORM\Column(type: 'text')]
    private $descriptionProduct;

    #[ORM\Column(type: 'float')]
    private $amountHTVA;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'datetime')]
    private $modifiedAt;

    #[ORM\Column(type: 'boolean')]
    private $lease;

    #[ORM\Column(type: 'boolean')]
    private $sale;

    #[ORM\ManyToOne(targetEntity: Option::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private $typeProduct;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: ProductColor::class)]
    private $productColors;

    public function __construct()
    {
        $this->productColors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAmountHTVA(): ?float
    {
        return $this->amountHTVA;
    }

    public function setAmountHTVA(float $amountHTVA): self
    {
        $this->amountHTVA = $amountHTVA;

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

    public function getModifiedAt(): ?\DateTimeInterface
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(\DateTimeInterface $modifiedAt): self
    {
        $this->modifiedAt = $modifiedAt;

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

    public function getTypeProduct(): ?Option
    {
        return $this->typeProduct;
    }

    public function setTypeProduct(?Option $typeProduct): self
    {
        $this->typeProduct = $typeProduct;

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
}
