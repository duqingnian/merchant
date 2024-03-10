<?php

namespace App\Entity;

use App\Repository\ChannelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChannelRepository::class)]
class Channel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 2, nullable: true)]
    private ?string $category = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 30)]
    private ?string $country = null;

    #[ORM\Column(length: 10)]
    private ?string $payin_pct = null;

    #[ORM\Column(length: 10)]
    private ?string $payin_sf = null;

    #[ORM\Column(length: 10)]
    private ?string $payout_pct = null;

    #[ORM\Column(length: 10)]
    private ?string $payout_sf = null;

    #[ORM\Column]
    private ?bool $is_active = null;

    #[ORM\Column(length: 30)]
    private ?string $timezone = null;

    #[ORM\Column(length: 10)]
    private ?string $payin_min = null;

    #[ORM\Column(length: 20)]
    private ?string $payin_max = null;

    #[ORM\Column(length: 10)]
    private ?string $payout_min = null;

    #[ORM\Column(length: 20)]
    private ?string $payout_max = null;

    #[ORM\Column(length: 30)]
    private ?string $amount = null;

    #[ORM\Column(length: 10)]
    private ?string $runtime = null;

    #[ORM\Column]
    private ?int $created_at = null;

    #[ORM\Column(length: 30)]
    private ?string $slug = null;

    #[ORM\Column(length: 20)]
    private ?string $telegram_group_id = null;

    #[ORM\Column(length: 255)]
    private ?string $note = null;
	
	#[ORM\Column]
    private ?bool $has_method = false;
	
	#[ORM\Column]
    private ?bool $pi_active = true;
	
	#[ORM\Column]
    private ?bool $po_active = true;
	
	#[ORM\Column]
    private ?bool $is_show = true;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): static
    {
        $this->category = $category;

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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getPayinPct(): ?string
    {
        return $this->payin_pct;
    }

    public function setPayinPct(string $payin_pct): static
    {
        $this->payin_pct = $payin_pct;

        return $this;
    }

    public function getPayinSf(): ?string
    {
        return $this->payin_sf;
    }

    public function setPayinSf(string $payin_sf): static
    {
        $this->payin_sf = $payin_sf;

        return $this;
    }

    public function getPayoutPct(): ?string
    {
        return $this->payout_pct;
    }

    public function setPayoutPct(string $payout_pct): static
    {
        $this->payout_pct = $payout_pct;

        return $this;
    }

    public function getPayoutSf(): ?string
    {
        return $this->payout_sf;
    }

    public function setPayoutSf(string $payout_sf): static
    {
        $this->payout_sf = $payout_sf;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): static
    {
        $this->is_active = $is_active;

        return $this;
    }

    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    public function setTimezone(string $timezone): static
    {
        $this->timezone = $timezone;

        return $this;
    }

    public function getPayinMin(): ?string
    {
        return $this->payin_min;
    }

    public function setPayinMin(string $payin_min): static
    {
        $this->payin_min = $payin_min;

        return $this;
    }

    public function getPayinMax(): ?string
    {
        return $this->payin_max;
    }

    public function setPayinMax(string $payin_max): static
    {
        $this->payin_max = $payin_max;

        return $this;
    }

    public function getPayoutMin(): ?string
    {
        return $this->payout_min;
    }

    public function setPayoutMin(string $payout_min): static
    {
        $this->payout_min = $payout_min;

        return $this;
    }

    public function getPayoutMax(): ?string
    {
        return $this->payout_max;
    }

    public function setPayoutMax(string $payout_max): static
    {
        $this->payout_max = $payout_max;

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

    public function getRuntime(): ?string
    {
        return $this->runtime;
    }

    public function setRuntime(string $runtime): static
    {
        $this->runtime = $runtime;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getTelegramGroupId(): ?string
    {
        return $this->telegram_group_id;
    }

    public function setTelegramGroupId(string $telegram_group_id): static
    {
        $this->telegram_group_id = $telegram_group_id;

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
	
	public function isHasMethod(): ?bool
    {
        return $this->has_method;
    }

    public function setHasMethod(bool $has_method): static
    {
        $this->has_method = $has_method;

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
	
	public function isPiActive(): ?bool
    {
        return $this->pi_active;
    }

    public function setPiActive(bool $pi_active): static
    {
        $this->pi_active = $pi_active;

        return $this;
    }

    public function isPoActive(): ?bool
    {
        return $this->po_active;
    }

    public function setPoActive(bool $po_active): static
    {
        $this->po_active = $po_active;

        return $this;
    }
}
