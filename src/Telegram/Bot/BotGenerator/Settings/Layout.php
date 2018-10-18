<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Bot\BotGenerator\Settings;

class Layout
{
    // ########################################

    /** @var \App\Entity\Telegram\Bot */
    private $bot;

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $text;

    /** @var \App\Telegram\Model\Type\ReplyMarkup\BaseAbstract */
    private $replyMarkup;

    // ########################################

    /**
     * @param \App\Entity\Telegram\Bot $bot
     * @param int                      $id
     * @param string                   $name
     * @param string                   $text
     */
    public function __construct(\App\Entity\Telegram\Bot $bot, int $id, string $name, string $text)
    {
        $this->bot  = $bot;
        $this->id   = $id;
        $this->name = $name;
        $this->text = $text;
    }

    // ########################################

    /**
     * @return \App\Telegram\Model\Type\ReplyMarkup\BaseAbstract
     */
    public function getReplyMarkup(): \App\Telegram\Model\Type\ReplyMarkup\BaseAbstract
    {
        return $this->replyMarkup;
    }

    /**
     * @param \App\Telegram\Model\Type\ReplyMarkup\BaseAbstract $replyMarkup
     */
    public function setReplyMarkup(\App\Telegram\Model\Type\ReplyMarkup\BaseAbstract $replyMarkup): void
    {
        $this->replyMarkup = $replyMarkup;
    }

    // ########################################
}
