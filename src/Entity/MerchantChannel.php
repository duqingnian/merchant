<?php

namespace App\Entity;

use App\Repository\MerchantChannelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MerchantChannelRepository::class)]
class MerchantChannel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $mid = null;

    #[ORM\Column]
    private ?int $cid = null;

    #[ORM\Column(length: 50)]
    private ?string $bundle = null;

    #[ORM\Column(length: 30)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $note = null;

    #[ORM\Column]
    private ?bool $is_active = null;

    #[ORM\Column]
    private ?int $created_at = null;

    #[ORM\Column(length: 10)]
    private ?string $pct = null;

    #[ORM\Column(length: 10)]
    private ?string $sf = null;
	
	#[ORM\Column(length: 10)]
             private ?string $min = null;

    #[ORM\Column(length: 10)]
    private ?string $max = null;

    #[ORM\Column]
    private ?bool $is_default = null;

    #[ORM\Column(length: 30)]
    private ?string $pay_limit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMid(): ?int
    {
        return $this->mid;
    }

    public function setMid(int $mid): static
    {
        $this->mid = $mid;

        return $this;
    }

    public function getCid(): ?int
    {
        return $this->cid;
    }

    public function setCid(int $cid): static
    {
        $this->cid = $cid;

        return $this;
    }

    public function getBundle(): ?string
    {
        return $this->bundle;
    }

    public function setBundle(string $bundle): static
    {
        $this->bundle = $bundle;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): static
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getCreatedAt(): ?int
    {
        return $this->created_at;
    }

    public function setCreatedAt(int $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getPct(): ?string
    {
        return $this->pct;
    }

    public function setPct(string $pct): static
    {
        $this->pct = $pct;

        return $this;
    }

    public function getSf(): ?string
    {
        return $this->sf;
    }

    public function setSf(string $sf): static
    {
        $this->sf = $sf;

        return $this;
    }

    public function getMin(): ?string
    {
        return $this->min;
    }

    public function setMin(string $min): static
    {
        $this->min = $min;

        return $this;
    }

    public function getMax(): ?string
    {
        return $this->max;
    }

    public function setMax(string $max): static
    {
        $this->max = $max;

        return $this;
    }

    public function isIsDefault(): ?bool
    {
        return $this->is_default;
    }

    public function setIsDefault(bool $is_default): static
    {
        $this->is_default = $is_default;

        return $this;
    }

    public function getPayLimit(): ?string
    {
        return $this->pay_limit;
    }

    public function setPayLimit(string $pay_limit): static
    {
        $this->pay_limit = $pay_limit;

        return $this;
    }
	
}
