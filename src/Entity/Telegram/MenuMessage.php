<?php

namespace App\Entity\Telegram;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\Table;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Telegram\MenuMessageRepository")
 * @Table(name="telegram_menu_message")})
 */
class MenuMessage
{
    // ########################################

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \App\Entity\Telegram\Bot
     * @ORM\ManyToOne(targetEntity="App\Entity\Telegram\Bot")
     * @JoinColumn(name="bot", referencedColumnName="id", onDelete="CASCADE")
     */
    private $bot;

    /**
     * @var \App\Entity\Telegram\Layout
     * @ORM\ManyToOne(targetEntity="App\Entity\Telegram\Layout")
     * @JoinColumn(name="layout", referencedColumnName="id", onDelete="CASCADE")
     */
    private $layout;

    /**
     * @ORM\Column(type="text")
     */
    private $actions;

    /**
     * @ORM\Column(type="string")
     */
    private $buttonText;

    // ########################################

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

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

    /**
     * @return \App\Entity\Telegram\Layout
     */
    public function getLayout(): \App\Entity\Telegram\Layout
    {
        return $this->layout;
    }

    /**
     * @param \App\Entity\Telegram\Layout $layout
     */
    public function setLayout(\App\Entity\Telegram\Layout $layout): void
    {
        $this->layout = $layout;
    }

    /**
     * @return array
     */
    public function getActions(): array
    {
        return (array)json_decode($this->actions, true);
    }

    /**
     * @param array $actions
     */
    public function setActions(array $actions): void
    {
        $this->actions = json_encode($actions, true);
    }

    public function getButtonText(): string
    {
        return $this->buttonText;
    }

    public function setButtonText(string $buttonText): void
    {
        $this->buttonText = $buttonText;
    }

    // ########################################
}
