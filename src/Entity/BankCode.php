<?php

namespace App\Entity;

use App\Repository\BankCodeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BankCodeRepository::class)]
class BankCode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $bank_name = null;

    #[ORM\Column(length: 20)]
    private ?string $channel_code = null;

    #[ORM\Column(length: 20)]
    private ?string $clean_code = null;

    #[ORM\Column]
    private ?int $cid = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBankName(): ?string
    {
        return $this->bank_name;
    }

    public function setBankName(string $bank_name): static
    {
        $this->bank_name = $bank_name;

        return $this;
    }

    public function getChannelCode(): ?string
    {
        return $this->channel_code;
    }

    public function setChannelCode(string $channel_code): static
    {
        $this->channel_code = $channel_code;

        return $this;
    }

    public function getCleanCode(): ?string
    {
        return $this->clean_code;
    }

    public function setCleanCode(string $clean_code): static
    {
        $this->clean_code = $clean_code;

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
