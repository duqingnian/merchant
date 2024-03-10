<?php

namespace App\Entity;

use App\Repository\ChannelBalanceLogRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChannelBalanceLogRepository::class)]
class ChannelBalanceLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $cid = null;

    #[ORM\Column(length: 20)]
    private ?string $balance_snapshot = null;

    #[ORM\Column(length: 20)]
    private ?string $balance = null;

    #[ORM\Column]
    private ?int $created_at = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBalanceSnapshot(): ?string
    {
        return $this->balance_snapshot;
    }

    public function setBalanceSnapshot(string $balance_snapshot): static
    {
        $this->balance_snapshot = $balance_snapshot;

        return $this;
    }

    public function getBalance(): ?string
    {
        return $this->balance;
    }

    public function setBalance(string $balance): static
    {
        $this->balance = $balance;

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
