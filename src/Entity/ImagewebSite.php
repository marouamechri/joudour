<?php

namespace App\Entity;

use App\Repository\ImagewebSiteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImagewebSiteRepository::class)]
class ImagewebSite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 40)]
    private $poster;

    #[ORM\Column(type: 'string', length: 50)]
    private $titrePoster;

    #[ORM\Column(type: 'string', length: 50)]
    private $posterTextBtn;

    #[ORM\Column(type: 'string', length: 40)]
    private $robe1;

    #[ORM\Column(type: 'string', length: 40)]
    private $robe2;

    #[ORM\Column(type: 'string', length: 40)]
    private $robe3;

    #[ORM\Column(type: 'string', length: 40)]
    private $imgShop1;

    #[ORM\Column(type: 'string', length: 40)]
    private $imgShop2;

    #[ORM\Column(type: 'string', length: 40)]
    private $imgShop3;

    #[ORM\Column(type: 'string', length: 40)]
    private $imgloca1;

    #[ORM\Column(type: 'string', length: 40)]
    private $imgloca2;

    #[ORM\Column(type: 'string', length: 40)]
    private $imgloca3;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    public function getTitrePoster(): ?string
    {
        return $this->titrePoster;
    }

    public function setTitrePoster(string $titrePoster): self
    {
        $this->titrePoster = $titrePoster;

        return $this;
    }

    public function getPosterTextBtn(): ?string
    {
        return $this->posterTextBtn;
    }

    public function setPosterTextBtn(string $posterTextBtn): self
    {
        $this->posterTextBtn = $posterTextBtn;

        return $this;
    }

    public function getRobe1(): ?string
    {
        return $this->robe1;
    }

    public function setRobe1(string $robe1): self
    {
        $this->robe1 = $robe1;

        return $this;
    }

    public function getRobe2(): ?string
    {
        return $this->robe2;
    }

    public function setRobe2(string $robe2): self
    {
        $this->robe2 = $robe2;

        return $this;
    }

    public function getRobe3(): ?string
    {
        return $this->robe3;
    }

    public function setRobe3(string $robe3): self
    {
        $this->robe3 = $robe3;

        return $this;
    }

    public function getImgShop1(): ?string
    {
        return $this->imgShop1;
    }

    public function setImgShop1(string $imgShop1): self
    {
        $this->imgShop1 = $imgShop1;

        return $this;
    }

    public function getImgShop2(): ?string
    {
        return $this->imgShop2;
    }

    public function setImgShop2(string $imgShop2): self
    {
        $this->imgShop2 = $imgShop2;

        return $this;
    }

    public function getImgShop3(): ?string
    {
        return $this->imgShop3;
    }

    public function setImgShop3(string $imgShop3): self
    {
        $this->imgShop3 = $imgShop3;

        return $this;
    }

    public function getImgloca1(): ?string
    {
        return $this->imgloca1;
    }

    public function setImgloca1(string $imgloca1): self
    {
        $this->imgloca1 = $imgloca1;

        return $this;
    }

    public function getImgloca2(): ?string
    {
        return $this->imgloca2;
    }

    public function setImgloca2(string $imgloca2): self
    {
        $this->imgloca2 = $imgloca2;

        return $this;
    }

    public function getImgloca3(): ?string
    {
        return $this->imgloca3;
    }

    public function setImgloca3(string $imgloca3): self
    {
        $this->imgloca3 = $imgloca3;

        return $this;
    }
}
