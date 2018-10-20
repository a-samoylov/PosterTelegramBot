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
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

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
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    private $posterAccount;

    /**
     * @var string|null
     * @ORM\Column(type="string", nullable=true)
     */
    private $posterAccessKey;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $currentLayout;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    private $posterMenu;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var int
     */
    private $posterSpotId;

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
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
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
     * @return string|null
     */
    public function getPosterAccount(): ?string
    {
        return $this->posterAccount;
    }

    /**
     * @param string|null $posterAccount
     */
    public function setPosterAccount(?string $posterAccount): void
    {
        $this->posterAccount = $posterAccount;
    }

    /**
     * @return string|null
     */
    public function getPosterAccessKey(): ?string
    {
        return $this->posterAccessKey;
    }

    /**
     * @param string|null $posterAccessKey
     */
    public function setPosterAccessKey(?string $posterAccessKey): void
    {
        $this->posterAccessKey = $posterAccessKey;
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

    public function getPosterMenu(): \App\Entity\User\Poster\Menu
    {
        return unserialize($this->posterMenu);
    }

    public function setPosterMenu(\App\Entity\User\Poster\Menu $posterMenu): void
    {
        $this->posterMenu = serialize($posterMenu);
    }

    /**
     * @return int
     */
    public function getPosterSpotId(): int
    {
        return $this->posterSpotId;
    }

    /**
     * @param int $posterSpotId
     */
    public function setPosterSpotId(int $posterSpotId): void
    {
        $this->posterSpotId = $posterSpotId;
    }
}
