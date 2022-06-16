<?php

namespace App\Entity;

use App\Repository\AdresseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdresseRepository::class)]
class Adresse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 250)]
    private $fullname;

    #[ORM\Column(type: 'string', length: 250)]
    private $tel;

    #[ORM\Column(type: 'string', length: 150)]
    private $adresse;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $message;

    #[ORM\Column(type: 'integer')]
    private $country_code;

    #[ORM\Column(type: 'string', length: 100)]
    private $city;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'adresses')]
    private $user;

    #[ORM\OneToMany(mappedBy: 'adress', targetEntity: Delivery::class, orphanRemoval: true)]
    private $deliveries;

    public function __construct()
    {
        $this->deliveries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }


    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getCountryCode(): ?int
    {
        return $this->country_code;
    }

    public function setCountryCode(int $country_code): self
    {
        $this->country_code = $country_code;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Delivery>
     */
    public function getDeliveries(): Collection
    {
        return $this->deliveries;
    }

    public function addDelivery(Delivery $delivery): self
    {
        if (!$this->deliveries->contains($delivery)) {
            $this->deliveries[] = $delivery;
            $delivery->setAdress($this);
        }

        return $this;
    }

    public function removeDelivery(Delivery $delivery): self
    {
        if ($this->deliveries->removeElement($delivery)) {
            // set the owning side to null (unless already changed)
            if ($delivery->getAdress() === $this) {
                $delivery->setAdress(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        //spr permet de mettre un espace sans mettre une balise que php ne peut interpréter
        $result = $this->fullname . "[spr]";
        $result .= $this->adresse . "[spr]";
        if ($this->message) {
            $result .= $this->message . "[spr]";
        }
        $result .= $this->country_code . "-" . $this->city . "[spr]";

        return $result. "[spr]";
    }
}
