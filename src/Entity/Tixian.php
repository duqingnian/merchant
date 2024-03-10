<?php

namespace App\Entity;

use App\Repository\TixianRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TixianRepository::class)]
class Tixian
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $mid = null;

    #[ORM\Column(length: 20)]
    private ?string $amount = null;

    #[ORM\Column(length: 50)]
    private ?string $wallet = null;

    #[ORM\Column(length: 64)]
    private ?string $created_ip = null;

    #[ORM\Column(length: 20)]
    private ?string $status = null;

    #[ORM\Column(length: 200)]
    private ?string $created_note = null;

    #[ORM\Column]
    private ?int $created_at = null;

    #[ORM\Column]
    private ?int $exec_at = null;

    #[ORM\Column(length: 200)]
    private ?string $exec_note = null;

    #[ORM\Column(length: 64)]
    private ?string $exec_ip = null;

    #[ORM\Column(length: 20)]
    private ?string $blance_snapshot = null;

    #[ORM\Column(length: 20)]
    private ?string $exec_blance_snapshot = null;
	
	#[ORM\Column]
    private ?int $exec_uid = null;

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

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getWallet(): ?string
    {
        return $this->wallet;
    }

    public function setWallet(string $wallet): static
    {
        $this->wallet = $wallet;

        return $this;
    }

    public function getCreatedIp(): ?string
    {
        return $this->created_ip;
    }

    public function setCreatedIp(string $created_ip): static
    {
        $this->created_ip = $created_ip;

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

    public function getCreatedNote(): ?string
    {
        return $this->created_note;
    }

    public function setCreatedNote(string $created_note): static
    {
        $this->created_note = $created_note;

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

    public function getExecAt(): ?int
    {
        return $this->exec_at;
    }

    public function setExecAt(int $exec_at): static
    {
        $this->exec_at = $exec_at;

        return $this;
    }

    public function getExecNote(): ?string
    {
        return $this->exec_note;
    }

    public function setExecNote(string $exec_note): static
    {
        $this->exec_note = $exec_note;

        return $this;
    }

    public function getExecIp(): ?string
    {
        return $this->exec_ip;
    }

    public function setExecIp(string $exec_ip): static
    {
        $this->exec_ip = $exec_ip;

        return $this;
    }

    public function getBlanceSnapshot(): ?string
    {
        return $this->blance_snapshot;
    }

    public function setBlanceSnapshot(string $blance_snapshot): static
    {
        $this->blance_snapshot = $blance_snapshot;

        return $this;
    }

    public function getExecBlanceSnapshot(): ?string
    {
        return $this->exec_blance_snapshot;
    }

    public function setExecBlanceSnapshot(string $exec_blance_snapshot): static
    {
        $this->exec_blance_snapshot = $exec_blance_snapshot;

        return $this;
    }
	
	public function getExecUid(): ?int
    {
        return $this->exec_uid;
    }

    public function setExecUid(int $exec_uid): static
    {
        $this->exec_uid = $exec_uid;

        return $this;
    }
}
