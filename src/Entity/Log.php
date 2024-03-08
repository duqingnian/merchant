<?php

namespace App\Entity;

use App\Repository\LogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LogRepository::class)]
class Log
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $bundle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $data = null;

    #[ORM\Column]
    private ?int $created_at = null;

    #[ORM\Column]
    private ?int $orderid = null;

    #[ORM\Column]
    private ?int $uid = null;

    #[ORM\Column]
    private ?int $cid = null;

    #[ORM\Column]
    private ?int $mid = null;

    #[ORM\Column(length: 40)]
    private ?string $ip = null;

    #[ORM\Column(length: 18, nullable: true)]
    private ?string $summary = null;

    #[ORM\Column]
    private ?bool $is_test = null;

    #[ORM\Column(length: 30)]
    private ?string $money_before = null;

    #[ORM\Column(length: 30)]
    private ?string $money = null;

    #[ORM\Column(length: 30)]
    private ?string $money_after = null;

    #[ORM\Column(length: 40)]
    private ?string $pno = null;

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

    public function getData(): ?string
    {
        return $this->data;
    }

    public function setData(string $data): static
    {
        $this->data = $data;

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

    public function getOrderid(): ?int
    {
        return $this->orderid;
    }

    public function setOrderid(int $orderid): static
    {
        $this->orderid = $orderid;

        return $this;
    }

    public function getUid(): ?int
    {
        return $this->uid;
    }

    public function setUid(int $uid): static
    {
        $this->uid = $uid;

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

    public function getMid(): ?int
    {
        return $this->mid;
    }

    public function setMid(int $mid): static
    {
        $this->mid = $mid;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): static
    {
        $this->ip = $ip;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): static
    {
        $this->summary = $summary;

        return $this;
    }

    public function isIsTest(): ?bool
    {
        return $this->is_test;
    }

    public function setIsTest(bool $is_test): static
    {
        $this->is_test = $is_test;

        return $this;
    }

    public function getMoneyBefore(): ?string
    {
        return $this->money_before;
    }

    public function setMoneyBefore(string $money_before): static
    {
        $this->money_before = $money_before;

        return $this;
    }

    public function getMoney(): ?string
    {
        return $this->money;
    }

    public function setMoney(string $money): static
    {
        $this->money = $money;

        return $this;
    }

    public function getMoneyAfter(): ?string
    {
        return $this->money_after;
    }

    public function setMoneyAfter(string $money_after): static
    {
        $this->money_after = $money_after;

        return $this;
    }

    public function getPno(): ?string
    {
        return $this->pno;
    }

    public function setPno(string $pno): static
    {
        $this->pno = $pno;

        return $this;
    }
}
