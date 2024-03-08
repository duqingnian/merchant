<?php

namespace App\Entity;

use App\Repository\MultiPayoutOrdersRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MultiPayoutOrdersRepository::class)]
class MultiPayoutOrders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $pid = null;

    #[ORM\Column(length: 40)]
    private ?string $pno = null;

    #[ORM\Column(length: 10)]
    private ?string $err_code = null;

    #[ORM\Column(length: 255)]
    private ?string $err_msg = null;

    #[ORM\Column(length: 1000)]
    private ?string $data = null;

    #[ORM\Column(length: 50)]
    private ?string $mno = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPid(): ?int
    {
        return $this->pid;
    }

    public function setPid(int $pid): static
    {
        $this->pid = $pid;

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

    public function getErrCode(): ?string
    {
        return $this->err_code;
    }

    public function setErrCode(string $err_code): static
    {
        $this->err_code = $err_code;

        return $this;
    }

    public function getErrMsg(): ?string
    {
        return $this->err_msg;
    }

    public function setErrMsg(string $err_msg): static
    {
        $this->err_msg = $err_msg;

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

    public function getMno(): ?string
    {
        return $this->mno;
    }

    public function setMno(string $mno): static
    {
        $this->mno = $mno;

        return $this;
    }
}
