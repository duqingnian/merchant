<?php

namespace App\Entity;

use App\Repository\PayProcessDataRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PayProcessDataRepository::class)]
class PayProcessData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $bundle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $data = null;

    #[ORM\Column(length: 50)]
    private ?string $pno = null;

    #[ORM\Column]
    private ?int $created_at = null;

    #[ORM\Column(nullable: true)]
    private ?int $mid = null;

    #[ORM\Column(nullable: true)]
    private ?int $cid = null;

    #[ORM\Column(length: 10)]
    private ?string $io = null;

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

    public function getPno(): ?string
    {
        return $this->pno;
    }

    public function setPno(string $pno): static
    {
        $this->pno = $pno;

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

    public function setCid(?int $cid): static
    {
        $this->cid = $cid;

        return $this;
    }

    public function getIo(): ?string
    {
        return $this->io;
    }

    public function setIo(string $io): static
    {
        $this->io = $io;

        return $this;
    }
}
