<?php

namespace App\Entity;

use App\Repository\TelegramBotCmdRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TelegramBotCmdRepository::class)]
class TelegramBotCmd
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $const_name = null;

    #[ORM\Column(length: 30)]
    private ?string $custom_name = null;

    #[ORM\Column(length: 1000)]
    private ?string $tip = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConstName(): ?string
    {
        return $this->const_name;
    }

    public function setConstName(string $const_name): static
    {
        $this->const_name = $const_name;

        return $this;
    }

    public function getCustomName(): ?string
    {
        return $this->custom_name;
    }

    public function setCustomName(string $custom_name): static
    {
        $this->custom_name = $custom_name;

        return $this;
    }

    public function getTip(): ?string
    {
        return $this->tip;
    }

    public function setTip(string $tip): static
    {
        $this->tip = $tip;

        return $this;
    }
}
