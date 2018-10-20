<?php

namespace App\Entity\Telegram;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\Table;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Telegram\LayoutRepository")
 * @Table(name="telegram_layout")})
 */
class Layout
{
    // ########################################

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=false, unique=true)
     */
    private $layoutId;

    /**
     * @var \App\Entity\Telegram\Bot
     * @ORM\OneToOne(targetEntity="App\Entity\Telegram\Bot")
     * @JoinColumn(name="bot", nullable=false, referencedColumnName="id")
     */
    private $bot;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=1000, nullable=false)
     */
    private $text;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $replyMarkup;

    // ########################################

    public function getId(): ?int
    {
        return $this->id;
    }

    // ########################################

    /**
     * @return int
     */
    public function getLayoutId(): int
    {
        return $this->layoutId;
    }

    /**
     * @param int $layoutId
     */
    public function setLayoutId($layoutId): void
    {
        $this->layoutId = $layoutId;
    }

    // ########################################

    /**
     * @return \App\Entity\Telegram\Bot
     */
    public function getBot(): \App\Entity\Telegram\Bot
    {
        return $this->bot;
    }

    /**
     * @param \App\Entity\Telegram\Bot $bot
     */
    public function setBot(\App\Entity\Telegram\Bot $bot): void
    {
        $this->bot = $bot;
    }

    // ########################################

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    // ########################################

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    // ########################################

    /**
     * @return mixed
     */
    public function getReplyMarkup()
    {
        return $this->replyMarkup;
    }

    /**
     * @param mixed $replyMarkup
     */
    public function setReplyMarkup($replyMarkup): void
    {
        $this->replyMarkup = $replyMarkup;
    }

    // ########################################
}
