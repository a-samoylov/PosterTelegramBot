<?php

namespace App\Entity\Telegram;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\Table;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Telegram\CallbackMessageRepository")
 * @Table(name="telegram_callback_message")})
 */
class CallbackMessage
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
     * @JoinColumn(name="bot", nullable=false, referencedColumnName="id", onDelete="CASCADE")
     */
    private $bot;

    /**
     * @var \App\Entity\Telegram\Layout
     * @ORM\ManyToOne(targetEntity="App\Entity\Telegram\Layout")
     * @JoinColumn(name="layout", nullable=false, referencedColumnName="id", onDelete="CASCADE")
     */
    private $layout;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $actions;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $buttonId;

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

    /**
     * @return mixed
     */
    public function getButtonId()
    {
        return $this->buttonId;
    }

    /**
     * @param mixed $buttonId
     */
    public function setButtonId($buttonId): void
    {
        $this->buttonId = $buttonId;
    }

    // ########################################
}
