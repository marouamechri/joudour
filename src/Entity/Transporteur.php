<?php

namespace App\Entity;

use App\Repository\TransporteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransporteurRepository::class)]
class Transporteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nameTransport;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'float')]
    private $pricesTransport;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameTransport(): ?string
    {
        return $this->nameTransport;
    }

    public function setNameTransport(string $nameTransport): self
    {
        $this->nameTransport = $nameTransport;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description ;

        return $this;
    }

    public function getPricesTransport(): ?float
    {
        return $this->pricesTransport /100;
    }

    public function setPricesTransport(float $pricesTransport): self
    {
        $this->pricesTransport = $pricesTransport *100;

        return $this;
    }

    public function getCratedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCratedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

     public function __toString()
    {
        $result = $this->nameTransport."[spr]";
        $result .= $this->description."[spr]";
        $result .= "Prix: ".($this->pricesTransport/100)." € [spr]";
        
        return $result;
    }
}
