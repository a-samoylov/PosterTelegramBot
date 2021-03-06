<?php

declare(strict_types=1);

namespace App\Entity\Telegram;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\Table;

/**
 * @ORM\Entity(repositoryClass="\App\Repository\Telegram\UserRepository")
 * @Table(name="telegram_user")})
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $phone;

    /**
     * @var \App\Entity\Telegram\Chat
     * @ORM\OneToOne(targetEntity="App\Entity\Telegram\Chat")
     * @JoinColumn(name="chat", nullable=true, referencedColumnName="id")
     */
    private $chat;

    /**
     * @var \App\Entity\Telegram\Bot
     * @ORM\OneToOne(targetEntity="App\Entity\Telegram\Bot")
     * @JoinColumn(name="telegram_bot", nullable=true, referencedColumnName="id")
     */
    private $telegramBot;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lastMessageId;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $orders;

    // ########################################

    public function getId(): int
    {
        return $this->id;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return \App\Entity\Telegram\Chat
     */
    public function getChat(): \App\Entity\Telegram\Chat
    {
        return $this->chat;
    }

    /**
     * @param \App\Entity\Telegram\Chat $chat
     */
    public function setChat(\App\Entity\Telegram\Chat $chat): void
    {
        $this->chat = $chat;
    }

    public function getLastMessageId(): int
    {
        return $this->lastMessageId;
    }

    public function setLastMessageId(int $lastMessageId): void
    {
        $this->lastMessageId = $lastMessageId;
    }

    public function getTelegramBot(): \App\Entity\Telegram\Bot
    {
        return $this->telegramBot;
    }

    public function setTelegramBot(\App\Entity\Telegram\Bot $telegramBot): void
    {
        $this->telegramBot = $telegramBot;
    }

    /**
     * @return array
     */
    public function getOrders()
    {
        return (array)json_decode($this->orders, true);
    }

    /**
     * @param array $orders
     */
    public function setOrders(array $orders): void
    {
        $this->orders = json_encode($orders);
    }
}
