<?php

namespace App\Entity;

use App\Repository\LoginLogRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoginLogRepository::class)]
class LoginLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 36)]
    private ?string $account = null;

    #[ORM\Column(length: 36)]
    private ?string $try_password = null;

    #[ORM\Column(length: 36)]
    private ?string $ip = null;

    #[ORM\Column(length: 255)]
    private ?string $agent = null;

    #[ORM\Column]
    private ?int $created_at = null;

    #[ORM\Column(length: 30)]
    private ?string $result = null;

    #[ORM\Column(length: 6)]
    private ?string $with_google = null;

    #[ORM\Column]
    private ?int $uid = null;

    #[ORM\Column]
    private ?int $mid = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccount(): ?string
    {
        return $this->account;
    }

    public function setAccount(string $account): static
    {
        $this->account = $account;

        return $this;
    }

    public function getTryPassword(): ?string
    {
        return $this->try_password;
    }

    public function setTryPassword(string $try_password): static
    {
        $this->try_password = $try_password;

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

    public function getAgent(): ?string
    {
        return $this->agent;
    }

    public function setAgent(string $agent): static
    {
        $this->agent = $agent;

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

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setResult(string $result): static
    {
        $this->result = $result;

        return $this;
    }

    public function getWithGoogle(): ?string
    {
        return $this->with_google;
    }

    public function setWithGoogle(string $with_google): static
    {
        $this->with_google = $with_google;

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

    public function getMid(): ?int
    {
        return $this->mid;
    }

    public function setMid(int $mid): static
    {
        $this->mid = $mid;

        return $this;
    }
}
