<?php

namespace App\Entity;

use App\Repository\ChannelColumnMapRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChannelColumnMapRepository::class)]
class ChannelColumnMap
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
	
    #[ORM\Column]
    private ?bool $is_require = null;

    #[ORM\Column]
    private ?bool $is_show = null;

    #[ORM\Column(length: 255)]
    private ?string $summary = null;

    #[ORM\Column]
    private ?int $cid = null;

    #[ORM\Column(length: 30)]
    private ?string $pcolumn = null;

    #[ORM\Column(length: 30)]
    private ?string $ccolumn = null;

    #[ORM\Column(length: 30)]
    private ?string $name = null;

    #[ORM\Column(length: 10)]
    private ?string $bundle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsRequire(): ?bool
    {
        return $this->is_require;
    }

    public function setIsRequire(bool $is_require): static
    {
        $this->is_require = $is_require;

        return $this;
    }

    public function isIsShow(): ?bool
    {
        return $this->is_show;
    }

    public function setIsShow(bool $is_show): static
    {
        $this->is_show = $is_show;

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

    public function getPcolumn(): ?string
    {
        return $this->pcolumn;
    }

    public function setPcolumn(string $pcolumn): static
    {
        $this->pcolumn = $pcolumn;

        return $this;
    }

    public function getCcolumn(): ?string
    {
        return $this->ccolumn;
    }

    public function setCcolumn(string $ccolumn): static
    {
        $this->ccolumn = $ccolumn;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
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
}
