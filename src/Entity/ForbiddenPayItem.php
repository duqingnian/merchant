<?php

namespace App\Entity;

use App\Repository\ForbiddenPayItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ForbiddenPayItemRepository::class)]
class ForbiddenPayItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $mid = null;

    #[ORM\Column]
    private ?int $cid = null;

    #[ORM\Column(length: 20)]
    private ?string $bundle = null;

    #[ORM\Column(length: 20)]
    private ?string $item_key = null;

    #[ORM\Column]
    private ?int $created_at = null;

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

    public function getItemKey(): ?string
    {
        return $this->item_key;
    }

    public function setItemKey(string $item_key): static
    {
        $this->item_key = $item_key;

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
}
