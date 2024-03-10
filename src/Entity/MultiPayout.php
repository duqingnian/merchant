<?php

namespace App\Entity;

use App\Repository\MultiPayoutRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MultiPayoutRepository::class)]
class MultiPayout
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $total_count = null;

    #[ORM\Column]
    private ?int $total_amount = null;

    #[ORM\Column]
    private ?int $generated_count = null;

    #[ORM\Column]
    private ?int $created_at = null;

    #[ORM\Column(length: 20)]
    private ?string $status = null;

    #[ORM\Column]
    private ?int $updated_at = null;

    #[ORM\Column]
    private ?int $complete_at = null;

    #[ORM\Column]
    private ?int $succ_count = null;

    #[ORM\Column(length: 20)]
    private ?string $generated_amount = null;

    #[ORM\Column]
    private ?int $succ_amount = null;

    #[ORM\Column(nullable: true)]
    private ?int $mid = null;

    #[ORM\Column]
    private ?int $cid = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalCount(): ?int
    {
        return $this->total_count;
    }

    public function setTotalCount(int $total_count): static
    {
        $this->total_count = $total_count;

        return $this;
    }

    public function getTotalAmount(): ?int
    {
        return $this->total_amount;
    }

    public function setTotalAmount(int $total_amount): static
    {
        $this->total_amount = $total_amount;

        return $this;
    }

    public function getGeneratedCount(): ?int
    {
        return $this->generated_count;
    }

    public function setGeneratedCount(int $generated_count): static
    {
        $this->generated_count = $generated_count;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getUpdatedAt(): ?int
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(int $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getCompleteAt(): ?int
    {
        return $this->complete_at;
    }

    public function setCompleteAt(int $complete_at): static
    {
        $this->complete_at = $complete_at;

        return $this;
    }

    public function getSuccCount(): ?int
    {
        return $this->succ_count;
    }

    public function setSuccCount(int $succ_count): static
    {
        $this->succ_count = $succ_count;

        return $this;
    }

    public function getGeneratedAmount(): ?string
    {
        return $this->generated_amount;
    }

    public function setGeneratedAmount(string $generated_amount): static
    {
        $this->generated_amount = $generated_amount;

        return $this;
    }

    public function getSuccAmount(): ?int
    {
        return $this->succ_amount;
    }

    public function setSuccAmount(int $succ_amount): static
    {
        $this->succ_amount = $succ_amount;

        return $this;
    }

    public function getMid(): ?int
    {
        return $this->mid;
    }

    public function setMid(?int $mid): static
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
}
