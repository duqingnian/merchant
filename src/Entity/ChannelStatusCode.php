<?php

namespace App\Entity;

use App\Repository\ChannelStatusCodeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChannelStatusCodeRepository::class)]
class ChannelStatusCode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $bundle = null;

    #[ORM\Column(length: 20)]
    private ?string $const_status = null;

    #[ORM\Column(length: 20)]
    private ?string $channel_code = null;

    #[ORM\Column(length: 50)]
    private ?string $summary = null;

    #[ORM\Column]
    private ?int $cid = null;

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

    public function getConstStatus(): ?string
    {
        return $this->const_status;
    }

    public function setConstStatus(string $const_status): static
    {
        $this->const_status = $const_status;

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

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): static
    {
        $this->summary = $summary;

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
