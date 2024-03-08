<?php

namespace App\Entity;

use App\Repository\DispatchRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DispatchRepository::class)]
class Dispatch
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $bundle = null;

    #[ORM\Column(length: 30)]
    private ?string $snapshot = null;

    #[ORM\Column(length: 30)]
    private ?string $amount = null;

    #[ORM\Column(length: 30)]
    private ?string $dispatched = null;

    #[ORM\Column]
    private ?int $merchant_id = null;

    #[ORM\Column(length: 100)]
    private ?string $note = null;

    #[ORM\Column]
    private ?int $created_at = null;

    #[ORM\Column]
    private ?int $user_id = null;

    #[ORM\Column(length: 20)]
    private ?string $module = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSnapshot(): ?string
    {
        return $this->snapshot;
    }

    public function setSnapshot(string $snapshot): static
    {
        $this->snapshot = $snapshot;

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

    public function getDispatched(): ?string
    {
        return $this->dispatched;
    }

    public function setDispatched(string $dispatched): static
    {
        $this->dispatched = $dispatched;

        return $this;
    }

    public function getMerchantId(): ?int
    {
        return $this->merchant_id;
    }

    public function setMerchantId(int $merchant_id): static
    {
        $this->merchant_id = $merchant_id;

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

    public function getCreatedAt(): ?int
    {
        return $this->created_at;
    }

    public function setCreatedAt(int $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getModule(): ?string
    {
        return $this->module;
    }

    public function setModule(string $module): static
    {
        $this->module = $module;

        return $this;
    }
}
