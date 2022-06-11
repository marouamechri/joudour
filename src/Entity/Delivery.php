<?php

namespace App\Entity;

use App\Repository\DeliveryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeliveryRepository::class)]
class Delivery
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $delevryDate;

    #[ORM\Column(type: 'string', length: 20)]
    private $status;

    #[ORM\ManyToOne(targetEntity: Adresse::class, inversedBy: 'deliveries')]
    #[ORM\JoinColumn(nullable: false)]
    private $adress;

    #[ORM\OneToMany(mappedBy: 'delevery', targetEntity: DeleveryLine::class, orphanRemoval: true)]
    private $deleveryLines;

    public function __construct()
    {
        $this->deleveryLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDelevryDate(): ?\DateTimeInterface
    {
        return $this->delevryDate;
    }

    public function setDelevryDate(\DateTimeInterface $delevryDate): self
    {
        $this->delevryDate = $delevryDate;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAdress(): ?Adresse
    {
        return $this->adress;
    }

    public function setAdress(?Adresse $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * @return Collection<int, DeleveryLine>
     */
    public function getDeleveryLines(): Collection
    {
        return $this->deleveryLines;
    }

    public function addDeleveryLine(DeleveryLine $deleveryLine): self
    {
        if (!$this->deleveryLines->contains($deleveryLine)) {
            $this->deleveryLines[] = $deleveryLine;
            $deleveryLine->setDelevery($this);
        }

        return $this;
    }

    public function removeDeleveryLine(DeleveryLine $deleveryLine): self
    {
        if ($this->deleveryLines->removeElement($deleveryLine)) {
            // set the owning side to null (unless already changed)
            if ($deleveryLine->getDelevery() === $this) {
                $deleveryLine->setDelevery(null);
            }
        }

        return $this;
    }
}
