<?php

namespace App\Entity;

use App\Repository\TelegramBotVoucherRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TelegramBotVoucherRepository::class)]
class TelegramBotVoucher
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $mid = null;

    #[ORM\Column]
    private ?int $cid = null;

    #[ORM\Column]
    private ?int $order_id = null;

    #[ORM\Column(length: 40)]
    private ?string $pno = null;

    #[ORM\Column(length: 40)]
    private ?string $mno = null;

    #[ORM\Column(length: 20)]
    private ?string $order_status = null;

    #[ORM\Column(length: 30)]
    private ?string $ask_chat_id = null;

    #[ORM\Column(length: 120)]
    private ?string $ask_chat_name = null;

    #[ORM\Column(length: 30)]
    private ?string $ask_message_id = null;

    #[ORM\Column(length: 30)]
    private ?string $target_message_id = null;

    #[ORM\Column(length: 30)]
    private ?string $target_message_date = null;

    #[ORM\Column(length: 30)]
    private ?string $ask_from_id = null;

    #[ORM\Column(length: 50)]
    private ?string $ask_from_name = null;

    #[ORM\Column]
    private ?int $ask_time = null;

    #[ORM\Column(length: 30)]
    private ?string $reply_chat_id = null;

    #[ORM\Column(length: 120)]
    private ?string $reply_chat_name = null;

    #[ORM\Column(length: 30)]
    private ?string $reply_message_id = null;

    #[ORM\Column(length: 30)]
    private ?string $reply_from_id = null;

    #[ORM\Column(length: 100)]
    private ?string $reply_from_name = null;

    #[ORM\Column]
    private ?int $reply_time = null;

    #[ORM\Column(length: 30)]
    private ?string $reply_result = null;

    #[ORM\Column(length: 1000)]
    private ?string $reply_photo = null;

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

    public function getCid(): ?int
    {
        return $this->cid;
    }

    public function setCid(int $cid): static
    {
        $this->cid = $cid;

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

    public function getPno(): ?string
    {
        return $this->pno;
    }

    public function setPno(string $pno): static
    {
        $this->pno = $pno;

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

    public function getOrderStatus(): ?string
    {
        return $this->order_status;
    }

    public function setOrderStatus(string $order_status): static
    {
        $this->order_status = $order_status;

        return $this;
    }

    public function getAskChatId(): ?string
    {
        return $this->ask_chat_id;
    }

    public function setAskChatId(string $ask_chat_id): static
    {
        $this->ask_chat_id = $ask_chat_id;

        return $this;
    }

    public function getAskChatName(): ?string
    {
        return $this->ask_chat_name;
    }

    public function setAskChatName(string $ask_chat_name): static
    {
        $this->ask_chat_name = $ask_chat_name;

        return $this;
    }

    public function getAskMessageId(): ?string
    {
        return $this->ask_message_id;
    }

    public function setAskMessageId(string $ask_message_id): static
    {
        $this->ask_message_id = $ask_message_id;

        return $this;
    }

    public function getTargetMessageId(): ?string
    {
        return $this->target_message_id;
    }

    public function setTargetMessageId(string $target_message_id): static
    {
        $this->target_message_id = $target_message_id;

        return $this;
    }

    public function getTargetMessageDate(): ?string
    {
        return $this->target_message_date;
    }

    public function setTargetMessageDate(string $target_message_date): static
    {
        $this->target_message_date = $target_message_date;

        return $this;
    }

    public function getAskFromId(): ?string
    {
        return $this->ask_from_id;
    }

    public function setAskFromId(string $ask_from_id): static
    {
        $this->ask_from_id = $ask_from_id;

        return $this;
    }

    public function getAskFromName(): ?string
    {
        return $this->ask_from_name;
    }

    public function setAskFromName(string $ask_from_name): static
    {
        $this->ask_from_name = $ask_from_name;

        return $this;
    }

    public function getAskTime(): ?int
    {
        return $this->ask_time;
    }

    public function setAskTime(int $ask_time): static
    {
        $this->ask_time = $ask_time;

        return $this;
    }

    public function getReplyChatId(): ?string
    {
        return $this->reply_chat_id;
    }

    public function setReplyChatId(string $reply_chat_id): static
    {
        $this->reply_chat_id = $reply_chat_id;

        return $this;
    }

    public function getReplyChatName(): ?string
    {
        return $this->reply_chat_name;
    }

    public function setReplyChatName(string $reply_chat_name): static
    {
        $this->reply_chat_name = $reply_chat_name;

        return $this;
    }

    public function getReplyMessageId(): ?string
    {
        return $this->reply_message_id;
    }

    public function setReplyMessageId(string $reply_message_id): static
    {
        $this->reply_message_id = $reply_message_id;

        return $this;
    }

    public function getReplyFromId(): ?string
    {
        return $this->reply_from_id;
    }

    public function setReplyFromId(string $reply_from_id): static
    {
        $this->reply_from_id = $reply_from_id;

        return $this;
    }

    public function getReplyFromName(): ?string
    {
        return $this->reply_from_name;
    }

    public function setReplyFromName(string $reply_from_name): static
    {
        $this->reply_from_name = $reply_from_name;

        return $this;
    }

    public function getReplyTime(): ?int
    {
        return $this->reply_time;
    }

    public function setReplyTime(int $reply_time): static
    {
        $this->reply_time = $reply_time;

        return $this;
    }

    public function getReplyResult(): ?string
    {
        return $this->reply_result;
    }

    public function setReplyResult(string $reply_result): static
    {
        $this->reply_result = $reply_result;

        return $this;
    }

    public function getReplyPhoto(): ?string
    {
        return $this->reply_photo;
    }

    public function setReplyPhoto(string $reply_photo): static
    {
        $this->reply_photo = $reply_photo;

        return $this;
    }
}
