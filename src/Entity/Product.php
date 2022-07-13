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

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $modifiedAt;

    #[ORM\Column(type: 'string')]
    private $action;


    #[ORM\ManyToOne(targetEntity: Option::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private $typeProduct;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: ProductColor::class, cascade: ['remove'])]
    private $productColors;

    #[ORM\Column(type: 'string', length: 40)]
    private $firstImage;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $active;

    #[ORM\Column(type: 'string', length: 10)]
    private $refProduct;

    #[ORM\Column(type: 'string', length: 15)]
    private $genre;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $newColletion;

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
        return $this->amountHTVA / 100;
    }

    public function setAmountHTVA(float $amountHTVA): self
    {
        $this->amountHTVA = $amountHTVA * 100;

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

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(string $action): self
    {
        $this->action = $action;

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

    public function getFirstImage(): ?string
    {
        return $this->firstImage;
    }

    public function setFirstImage(string $firstImage): self
    {
        $this->firstImage = $firstImage;

        return $this;
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

    public function getRefProduct(): ?string
    {
        return $this->refProduct;
    }

    public function setRefProduct(string $refProduct): self
    {
        $this->refProduct = $refProduct;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }


    public function isNewColletion(): ?bool
    {
        return $this->newColletion;
    }

    public function setNewColletion(bool $newColletion): self
    {
        $this->newColletion = $newColletion;

        return $this;
    }
    public function __toString()
    {
        return $this->id;
    }
}
