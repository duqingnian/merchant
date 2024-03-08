<?php

namespace App\Entity;

use App\Repository\OrderPayoutRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderPayoutRepository::class)]
class OrderPayout
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
    private ?string $amount = null;

    #[ORM\Column(length: 50)]
    private ?string $cno = null;

    #[ORM\Column(length: 50)]
    private ?string $mno = null;

    #[ORM\Column(length: 50)]
    private ?string $pno = null;

    #[ORM\Column(length: 20)]
    private ?string $status = null;

    #[ORM\Column]
    private ?int $created_at = null;

    #[ORM\Column(length: 10)]
    private ?string $cpct = null;

    #[ORM\Column(length: 10)]
    private ?string $csf = null;

    #[ORM\Column(length: 10)]
    private ?string $cfee = null;

    #[ORM\Column(length: 10)]
    private ?string $mpct = null;

    #[ORM\Column(length: 10)]
    private ?string $msf = null;

    #[ORM\Column(length: 10)]
    private ?string $mfee = null;

    #[ORM\Column(length: 20)]
    private ?string $ramount = null;

    #[ORM\Column(length: 50)]
    private ?string $note = null;

    #[ORM\Column]
    private ?bool $is_test = null;

    #[ORM\Column(length: 255)]
    private ?string $merchant_notify_url = null;

    #[ORM\Column(length: 20)]
    private ?string $country = null;

    #[ORM\Column(length: 10)]
    private ?string $currency = null;

    #[ORM\Column(length: 20)]
    private ?string $original_status = null;

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

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCno(): ?string
    {
        return $this->cno;
    }

    public function setCno(string $cno): static
    {
        $this->cno = $cno;

        return $this;
    }

    public function getMno(): ?string
    {
        return $this->mno;
    }

    public function setMno(string $mno): static
    {
        $this->mno = $mno;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

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

    public function getCpct(): ?string
    {
        return $this->cpct;
    }

    public function setCpct(string $cpct): static
    {
        $this->cpct = $cpct;

        return $this;
    }

    public function getCsf(): ?string
    {
        return $this->csf;
    }

    public function setCsf(string $csf): static
    {
        $this->csf = $csf;

        return $this;
    }

    public function getCfee(): ?string
    {
        return $this->cfee;
    }

    public function setCfee(string $cfee): static
    {
        $this->cfee = $cfee;

        return $this;
    }

    public function getMpct(): ?string
    {
        return $this->mpct;
    }

    public function setMpct(string $mpct): static
    {
        $this->mpct = $mpct;

        return $this;
    }

    public function getMsf(): ?string
    {
        return $this->msf;
    }

    public function setMsf(string $msf): static
    {
        $this->msf = $msf;

        return $this;
    }

    public function getMfee(): ?string
    {
        return $this->mfee;
    }

    public function setMfee(string $mfee): static
    {
        $this->mfee = $mfee;

        return $this;
    }

    public function getRamount(): ?string
    {
        return $this->ramount;
    }

    public function setRamount(string $ramount): static
    {
        $this->ramount = $ramount;

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

    public function isIsTest(): ?bool
    {
        return $this->is_test;
    }

    public function setIsTest(bool $is_test): static
    {
        $this->is_test = $is_test;

        return $this;
    }

    public function getMerchantNotifyUrl(): ?string
    {
        return $this->merchant_notify_url;
    }

    public function setMerchantNotifyUrl(string $merchant_notify_url): static
    {
        $this->merchant_notify_url = $merchant_notify_url;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getOriginalStatus(): ?string
    {
        return $this->original_status;
    }

    public function setOriginalStatus(string $original_status): static
    {
        $this->original_status = $original_status;

        return $this;
    }
}
