<?php

namespace App\Entity;

use App\Repository\CutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CutRepository::class)]
class Cut
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 5)]
    private $cutValue;

    #[ORM\OneToMany(mappedBy: 'cut', targetEntity: ProductCut::class, cascade:['remove'])]
    private $productCuts;

    public function __construct()
    {
        $this->productCuts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCutValue(): ?string
    {
        return $this->cutValue;
    }

    public function setCutValue(string $cutValue): self
    {
        $this->cutValue = $cutValue;

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
            $productCut->setCut($this);
        }

        return $this;
    }

    public function removeProductCut(ProductCut $productCut): self
    {
        if ($this->productCuts->removeElement($productCut)) {
            // set the owning side to null (unless already changed)
            if ($productCut->getCut() === $this) {
                $productCut->setCut(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->cutValue;
    }

}
