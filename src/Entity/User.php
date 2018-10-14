<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass="\App\Repository\UserRepository")
 */
class User
{
    // ########################################

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
     * @JoinColumn(name="chat", nullable=false, referencedColumnName="id")
     */
    private $chat;

    /**
     * @var \App\Entity\Telegram\Bot
     * @ORM\OneToOne(targetEntity="App\Entity\Telegram\Bot")
     * @JoinColumn(name="telegram_bot", nullable=false, referencedColumnName="id")
     */
    private $telegramBot;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $currentLayout;

    // ########################################

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
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

    /**
     * @return \App\Entity\Telegram\Bot
     */
    public function getTelegramBot(): \App\Entity\Telegram\Bot
    {
        return $this->telegramBot;
    }

    /**
     * @param \App\Entity\Telegram\Bot $telegramBot
     */
    public function setTelegramBot(\App\Entity\Telegram\Bot $telegramBot): void
    {
        $this->telegramBot = $telegramBot;
    }

    /**
     * @return int
     */
    public function getCurrentLayout(): int
    {
        return $this->currentLayout;
    }

    /**
     * @param int $currentLayout
     */
    public function setCurrentLayout(int $currentLayout): void
    {
        $this->currentLayout = $currentLayout;
    }

    // ########################################
}
