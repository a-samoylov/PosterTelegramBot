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
     * @ORM\OneToOne(targetEntity="App\Entity\Telegram\Bot")
     * @JoinColumn(name="bot", nullable=false, referencedColumnName="id")
     */
    private $bot;

    /**
     * @var \App\Entity\Telegram\Layout
     * @ORM\OneToOne(targetEntity="App\Entity\Telegram\Layout")
     * @JoinColumn(name="layout", nullable=false, referencedColumnName="id")
     */
    private $layout;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $action;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $buttonId;

    // ########################################
}
