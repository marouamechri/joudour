<?php

namespace App\Entity;

use App\Repository\BillRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BillRepository::class)]
class Bill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\OneToMany(mappedBy: 'bill', targetEntity: BillLine::class, orphanRemoval: true)]
    private $billLines;

    public function __construct()
    {
        $this->billLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, BillLine>
     */
    public function getBillLines(): Collection
    {
        return $this->billLines;
    }

    public function addBillLine(BillLine $billLine): self
    {
        if (!$this->billLines->contains($billLine)) {
            $this->billLines[] = $billLine;
            $billLine->setBill($this);
        }

        return $this;
    }

    public function removeBillLine(BillLine $billLine): self
    {
        if ($this->billLines->removeElement($billLine)) {
            // set the owning side to null (unless already changed)
            if ($billLine->getBill() === $this) {
                $billLine->setBill(null);
            }
        }

        return $this;
    }
}
