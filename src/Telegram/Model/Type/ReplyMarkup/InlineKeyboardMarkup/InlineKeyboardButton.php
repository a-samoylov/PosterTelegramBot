<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup;

class InlineKeyboardButton
{
    // ########################################

    /**
     * @var string
     */
    protected $text = null;

    /**
     * Optional.
     *
     * @var string
     */
    protected $url = null;

    /**
     * Optional.
     *
     * @var string
     */
    protected $callbackData = null;

    /**
     * Optional.
     *
     * @var string
     */
    protected $switchInlineQuery = null;

    /**
     * Optional.
     *
     * @var string
     */
    protected $switchInlineQueryCurrentChat = null;

    /**
     * Optional.
     *
     * @var \App\Telegram\Model\Type\Games\CallbackGame
     */
    protected $callbackCame = null;

    /**
     * Optional.
     *
     * @var bool
     */
    protected $pay = null;

    // ########################################

    /**
     * InlineKeyboardButton constructor.
     *
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
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

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    // ########################################

    /**
     * @return bool
     */
    public function isHasCallbackData(): bool
    {
        return !is_null($this->callbackData);
    }

    /**
     * @return string
     */
    public function getCallbackData(): string
    {
        return $this->callbackData;
    }

    /**
     * @param string $callbackData
     */
    public function setCallbackData(string $callbackData): void
    {
        $this->callbackData = $callbackData;
    }

    // ########################################

    /**
     * @return string
     */
    public function getSwitchInlineQuery(): string
    {
        return $this->switchInlineQuery;
    }

    /**
     * @param string $switchInlineQuery
     */
    public function setSwitchInlineQuery(string $switchInlineQuery): void
    {
        $this->switchInlineQuery = $switchInlineQuery;
    }

    /**
     * @return string
     */
    public function getSwitchInlineQueryCurrentChat(): string
    {
        return $this->switchInlineQueryCurrentChat;
    }

    /**
     * @param string $switchInlineQueryCurrentChat
     */
    public function setSwitchInlineQueryCurrentChat(string $switchInlineQueryCurrentChat): void
    {
        $this->switchInlineQueryCurrentChat = $switchInlineQueryCurrentChat;
    }

    /**
     * @return \App\Telegram\Model\Type\Games\CallbackGame
     */
    public function getCallbackCame(): \App\Telegram\Model\Type\Games\CallbackGame
    {
        return $this->callbackCame;
    }

    /**
     * @param \App\Telegram\Model\Type\Games\CallbackGame $callbackCame
     */
    public function setCallbackCame(\App\Telegram\Model\Type\Games\CallbackGame $callbackCame): void
    {
        $this->callbackCame = $callbackCame;
    }

    /**
     * @return bool
     */
    public function isPay(): bool
    {
        return $this->pay;
    }

    /**
     * @param bool $pay
     */
    public function setPay(bool $pay): void
    {
        $this->pay = $pay;
    }

    // ########################################
}
