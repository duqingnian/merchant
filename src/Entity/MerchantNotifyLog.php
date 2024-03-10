<?php

namespace App\Entity;

use App\Repository\MerchantNotifyLogRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MerchantNotifyLogRepository::class)]
class MerchantNotifyLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 4)]
    private ?string $delay = null;

    #[ORM\Column]
    private ?int $target_time = null;

    #[ORM\Column]
    private ?int $order_id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $data = null;

    #[ORM\Column]
    private ?int $created_at = null;

    #[ORM\Column(length: 255)]
    private ?string $merchant_notify_url = null;

    #[ORM\Column(length: 4)]
    private ?string $ret_http_code = null;

    #[ORM\Column(length: 255)]
    private ?string $ret = null;

    #[ORM\Column(length: 20)]
    private ?string $bundle = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDelay(): ?string
    {
        return $this->delay;
    }

    public function setDelay(string $delay): static
    {
        $this->delay = $delay;

        return $this;
    }

    public function getTargetTime(): ?int
    {
        return $this->target_time;
    }

    public function setTargetTime(int $target_time): static
    {
        $this->target_time = $target_time;

        return $this;
    }

    public function getOrderId(): ?int
    {
        return $this->order_id;
    }

    public function setOrderId(int $order_id): static
    {
        $this->order_id = $order_id;

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

    public function getCreatedAt(): ?int
    {
        return $this->created_at;
    }

    public function setCreatedAt(int $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getMerchantNotifyUrl(): ?string
    {
        return $this->merchant_notify_url;
    }

    public function setMerchantNotifyUrl(string $merchant_notify_url): static
    {
        $this->merchant_notify_url = $merchant_notify_url;

        return $this;
    }

    public function getRetHttpCode(): ?string
    {
        return $this->ret_http_code;
    }

    public function setRetHttpCode(string $ret_http_code): static
    {
        $this->ret_http_code = $ret_http_code;

        return $this;
    }

    public function getRet(): ?string
    {
        return $this->ret;
    }

    public function setRet(string $ret): static
    {
        $this->ret = $ret;

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
