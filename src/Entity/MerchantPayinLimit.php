<?php

namespace App\Entity;

use App\Repository\MerchantPayinLimitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MerchantPayinLimitRepository::class)]
class MerchantPayinLimit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $mid = null;

    #[ORM\Column]
    private ?int $cid = null;

    #[ORM\Column]
    private ?int $start_at = null;

    #[ORM\Column]
    private ?int $closed_at = null;

    #[ORM\Column(length: 30)]
    private ?string $limit_amount = null;

    #[ORM\Column(length: 30)]
    private ?string $current_amount = null;

    #[ORM\Column(length: 20)]
    private ?string $last_out_limit_set = null;

    #[ORM\Column(length: 20)]
    private ?string $last_out_limit_amount = null;

    #[ORM\Column]
    private ?int $first_order_id = null;

    #[ORM\Column]
    private ?int $last_order_id = null;

    #[ORM\Column]
    private ?bool $is_closed = null;

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

    public function getStartAt(): ?int
    {
        return $this->start_at;
    }

    public function setStartAt(int $start_at): static
    {
        $this->start_at = $start_at;

        return $this;
    }

    public function getClosedAt(): ?int
    {
        return $this->closed_at;
    }

    public function setClosedAt(int $closed_at): static
    {
        $this->closed_at = $closed_at;

        return $this;
    }

    public function getLimitAmount(): ?string
    {
        return $this->limit_amount;
    }

    public function setLimitAmount(string $limit_amount): static
    {
        $this->limit_amount = $limit_amount;

        return $this;
    }

    public function getCurrentAmount(): ?string
    {
        return $this->current_amount;
    }

    public function setCurrentAmount(string $current_amount): static
    {
        $this->current_amount = $current_amount;

        return $this;
    }

    public function getLastOutLimitSet(): ?string
    {
        return $this->last_out_limit_set;
    }

    public function setLastOutLimitSet(string $last_out_limit_set): static
    {
        $this->last_out_limit_set = $last_out_limit_set;

        return $this;
    }

    public function getLastOutLimitAmount(): ?string
    {
        return $this->last_out_limit_amount;
    }

    public function setLastOutLimitAmount(string $last_out_limit_amount): static
    {
        $this->last_out_limit_amount = $last_out_limit_amount;

        return $this;
    }

    public function getFirstOrderId(): ?int
    {
        return $this->first_order_id;
    }

    public function setFirstOrderId(int $first_order_id): static
    {
        $this->first_order_id = $first_order_id;

        return $this;
    }

    public function getLastOrderId(): ?int
    {
        return $this->last_order_id;
    }

    public function setLastOrderId(int $last_order_id): static
    {
        $this->last_order_id = $last_order_id;

        return $this;
    }

    public function isIsClosed(): ?bool
    {
        return $this->is_closed;
    }

    public function setIsClosed(bool $is_closed): static
    {
        $this->is_closed = $is_closed;

        return $this;
    }
}
