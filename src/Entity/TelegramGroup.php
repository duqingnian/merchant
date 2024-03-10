<?php

namespace App\Entity;

use App\Repository\TelegramGroupRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TelegramGroupRepository::class)]
class TelegramGroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $mid = null;

    #[ORM\Column]
    private ?int $created_at = null;

    #[ORM\Column(length: 20)]
    private ?string $bind_from_id = null;

    #[ORM\Column(length: 50)]
    private ?string $bind_from_name = null;

    #[ORM\Column(length: 30)]
    private ?string $chat_id = null;

    #[ORM\Column(length: 100)]
    private ?string $chat_title = null;

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

    public function getCreatedAt(): ?int
    {
        return $this->created_at;
    }

    public function setCreatedAt(int $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getBindFromId(): ?string
    {
        return $this->bind_from_id;
    }

    public function setBindFromId(string $bind_from_id): static
    {
        $this->bind_from_id = $bind_from_id;

        return $this;
    }

    public function getBindFromName(): ?string
    {
        return $this->bind_from_name;
    }

    public function setBindFromName(string $bind_from_name): static
    {
        $this->bind_from_name = $bind_from_name;

        return $this;
    }

    public function getChatId(): ?string
    {
        return $this->chat_id;
    }

    public function setChatId(string $chat_id): static
    {
        $this->chat_id = $chat_id;

        return $this;
    }

    public function getChatTitle(): ?string
    {
        return $this->chat_title;
    }

    public function setChatTitle(string $chat_title): static
    {
        $this->chat_title = $chat_title;

        return $this;
    }
}
