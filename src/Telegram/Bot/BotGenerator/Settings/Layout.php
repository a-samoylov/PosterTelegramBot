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

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $text;

    /** @var array */
    private $replyMarkup;

    // ########################################

    /**
     * @param int    $id
     * @param string $name
     * @param string $text
     */
    public function __construct(int $id, string $name, string $text)
    {
        $this->id   = $id;
        $this->name = $name;
        $this->text = $text;
    }

    // ########################################

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    // ########################################

    /**
     * @return array
     */
    public function getReplyMarkup(): array
    {
        return $this->replyMarkup;
    }

    /**
     * @param array $replyMarkup
     */
    public function setReplyMarkup(array $replyMarkup): void
    {
        $this->replyMarkup = $replyMarkup;
    }

    // ----------------------------------------

    public function isHasReplyMarkup(): bool
    {
        return is_null($this->replyMarkup);
    }

    public function isHasReplyMarkupInlineKeyboard(): bool
    {
        return $this->replyMarkup instanceof \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup;
    }

    public function isHasReplyMarkupReplyKeyboard(): bool
    {
        return $this->replyMarkup instanceof \App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardMarkup;
    }

    // ########################################
}
