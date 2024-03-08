<?php

namespace App\Entity;

use App\Repository\MerchantRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MerchantRepository::class)]
class Merchant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $uid = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 20)]
    private ?string $country = null;

    #[ORM\Column(length: 100)]
    private ?string $payin_appid = null;

    #[ORM\Column(length: 100)]
    private ?string $payin_secret = null;

    #[ORM\Column(length: 100)]
    private ?string $payout_appid = null;

    #[ORM\Column(length: 100)]
    private ?string $payout_secret = null;

    #[ORM\Column(length: 30)]
    private ?string $amount = null;

    #[ORM\Column(length: 30)]
    private ?string $df_pool = null;

    #[ORM\Column(length: 30)]
    private ?string $freeze_pool = null;

    #[ORM\Column]
    private ?bool $is_active = null;

    #[ORM\Column(length: 10)]
    private ?string $runtime = null;

    #[ORM\Column]
    private ?int $created_at = null;

    #[ORM\Column(length: 2)]
    private ?string $category = null;

    #[ORM\Column(length: 15)]
    private ?string $telegram_group_id = null;

    #[ORM\Column]
    private ?bool $is_test = null;

    #[ORM\Column(length: 20)]
    private ?string $test_amount = null;

    #[ORM\Column(length: 20)]
    private ?string $test_df_pool = null;

    #[ORM\Column(length: 36)]
    private ?string $vip_google_secret = null;

    #[ORM\Column]
    private ?bool $vip_google_binded = null;
	
	#[ORM\Column]
    private ?int $proxy_id = null;
	
	#[ORM\Column(length: 100)]
    private ?string $logo = null;
	
	#[ORM\Column]
    private ?float $txing_amount = null;
	
	#[ORM\Column(length: 20)]
    private ?string $yw_telegram_group_id = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPayinAppid(): ?string
    {
        return $this->payin_appid;
    }

    public function setPayinAppid(string $payin_appid): static
    {
        $this->payin_appid = $payin_appid;

        return $this;
    }

    public function getPayinSecret(): ?string
    {
        return $this->payin_secret;
    }

    public function setPayinSecret(string $payin_secret): static
    {
        $this->payin_secret = $payin_secret;

        return $this;
    }

    public function getPayoutAppid(): ?string
    {
        return $this->payout_appid;
    }

    public function setPayoutAppid(string $payout_appid): static
    {
        $this->payout_appid = $payout_appid;

        return $this;
    }

    public function getPayoutSecret(): ?string
    {
        return $this->payout_secret;
    }

    public function setPayoutSecret(string $payout_secret): static
    {
        $this->payout_secret = $payout_secret;

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

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getDfPool(): ?string
    {
        return $this->df_pool;
    }

    public function setDfPool(string $df_pool): static
    {
        $this->df_pool = $df_pool;

        return $this;
    }

    public function getFreezePool(): ?string
    {
        return $this->freeze_pool;
    }

    public function setFreezePool(string $freeze_pool): static
    {
        $this->freeze_pool = $freeze_pool;

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

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

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

    public function isIsTest(): ?bool
    {
        return $this->is_test;
    }

    public function setIsTest(bool $is_test): static
    {
        $this->is_test = $is_test;

        return $this;
    }

    public function getTestAmount(): ?string
    {
        return $this->test_amount;
    }

    public function setTestAmount(string $test_amount): static
    {
        $this->test_amount = $test_amount;

        return $this;
    }

    public function getTestDfPool(): ?string
    {
        return $this->test_df_pool;
    }

    public function setTestDfPool(string $test_df_pool): static
    {
        $this->test_df_pool = $test_df_pool;

        return $this;
    }

    public function getVipGoogleSecret(): ?string
    {
        return $this->vip_google_secret;
    }

    public function setVipGoogleSecret(string $vip_google_secret): static
    {
        $this->vip_google_secret = $vip_google_secret;

        return $this;
    }

    public function isVipGoogleBinded(): ?bool
    {
        return $this->vip_google_binded;
    }

    public function setVipGoogleBinded(bool $vip_google_binded): static
    {
        $this->vip_google_binded = $vip_google_binded;

        return $this;
    }
	
	public function getProxyId(): ?int
    {
        return $this->proxy_id;
    }

    public function setProxyId(int $proxy_id): static
    {
        $this->proxy_id = $proxy_id;

        return $this;
    }
	
	public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }
	
	public function getTxingAmount(): ?float
    {
        return $this->txing_amount;
    }

    public function setTxingAmount(float $txing_amount): static
    {
        $this->txing_amount = $txing_amount;

        return $this;
    }
	
	public function getYwTelegramGroupId(): ?string
    {
        return $this->yw_telegram_group_id;
    }

    public function setYwTelegramGroupId(string $yw_telegram_group_id): static
    {
        $this->yw_telegram_group_id = $yw_telegram_group_id;

        return $this;
    }
}
