<?php

namespace App\Entity;

use App\Repository\ProductColorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductColorRepository::class)]
class ProductColor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Colors::class, inversedBy: 'productColors')]
    #[ORM\JoinColumn(nullable: false)]
    private $color;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'productColors')]
    #[ORM\JoinColumn(nullable: false)]
    private $product;

    

    #[ORM\OneToMany(mappedBy: 'productColor', targetEntity: ProductCut::class,orphanRemoval:true, cascade:['remove'])]
    private $productCuts;

    #[ORM\OneToMany(mappedBy: 'productColor', targetEntity: Picture::class,orphanRemoval:true, cascade:['persist', 'remove'])]
    private $pictures;

    public function __construct()
    {
        $this->productCuts = new ArrayCollection();
        $this->pictures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColor(): ?Colors
    {
        return $this->color;
    }

    public function setColor(?Colors $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

   

   
   

    /**
     * @return Collection<int, ProductCut>
     */
    public function getProductCuts(): Collection
    {
        return $this->productCuts;
    }

    public function addProductCut(ProductCut $productCut): self
    {
        if (!$this->productCuts->contains($productCut)) {
            $this->productCuts[] = $productCut;
            $productCut->setProductColor($this);
        }

        return $this;
    }

    public function removeProductCut(ProductCut $productCut): self
    {
        if ($this->productCuts->removeElement($productCut)) {
            // set the owning side to null (unless already changed)
            if ($productCut->getProductColor() === $this) {
                $productCut->setProductColor(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->color->getRefColor();
    }

    /**
     * @return Collection<int, Picture>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setProductColor($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getProductColor() === $this) {
                $picture->setProductColor(null);
            }
        }

        return $this;
    }
    public function __toSting()
    {
        return $this->id;
    }
    
}
