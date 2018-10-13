<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Methods\Send;

class Message extends \App\Telegram\Model\Methods\BaseAbstract
{
    private const HTML_PARSE_MODE     = 'HTML';
    private const MARKDOWN_PARSE_MODE = 'Markdown';

    // ########################################

    /**
     * @var int
     */
    private $chatId;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $parseMode;

    /**
     * @var bool
     */
    private $disableWebPagePreview;

    /**
     * @var bool
     */
    private $disableNotification;

    /**
     * @var int
     */
    private $replyToMessageId;

    /**
     * @var \App\Telegram\Model\Type\ReplyMarkup\BaseAbstract
     */
    private $replyMarkup;

    // ########################################

    /**
     * @param string|integer $chatId
     * @param string         $text
     */
    public function __construct($chatId, string $text)
    {
        $this->chatId = $chatId;
        $this->text   = $text;
    }

    // ########################################

    protected function getMethodName(): string
    {
        return 'sendMessage';
    }

    protected function getRequestParams(): array
    {
        $result = [
            'chat_id' => $this->chatId,
            'text'    => $this->text,
        ];

        if ($this->hasReplyMarkup()) {
            if ($this->isReplyMarkupReplyKeyboardMarkup()) {
                /**
                 * @var \App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardMarkup $replyKeyboardMarkup
                 */
                $replyKeyboardMarkup = $this->getReplyMarkup();

                $keyboard = [];
                foreach ($replyKeyboardMarkup->getKeyboardButtonsRows() as $keyboardButtonRows) {

                    $row = [];

                    /** @var \App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardMarkup\KeyboardButton $keyboardButton */
                    foreach ($keyboardButtonRows as $keyboardButton) {
                        $row[] = [
                            'text'             => $keyboardButton->getText(),
                            'request_contact'  => $keyboardButton->isRequestContact(),
                            'request_location' => $keyboardButton->isRequestLocation()
                        ];
                    }

                    $keyboard[] = $row;
                }

                $replyMarkup = [
                    'keyboard'          => $keyboard,
                    'resize_keyboard'   => $replyKeyboardMarkup->isResizeKeyboard(),
                    'one_time_keyboard' => $replyKeyboardMarkup->isOneTimeKeyboard(),
                    'selective'         => $replyKeyboardMarkup->isSelective()
                ];

                $result['reply_markup'] = $replyMarkup;
            }

            if ($this->isReplyMarkupInlineKeyboardMarkup()) {
                /**
                 * @var \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup $inlineKeyboardMarkup
                 */
                $inlineKeyboardMarkup = $this->getReplyMarkup();

                $inlineKeyboard = [];
                foreach ($inlineKeyboardMarkup->getInlineKeyboardRows() as $row) {
                    /** @var \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\InlineKeyboardButton $inlineKeyboardButton */
                    foreach ($row as $inlineKeyboardButton) {
                        $inlineKeyboard[] = [
                            'text'          => $inlineKeyboardButton->getText(),
                            'callback_data' => $inlineKeyboardButton->getCallbackData()
                        ];
                    }

                    //todo other
                }

                $result['reply_markup'] = [
                    'inline_keyboard' => [
                        $inlineKeyboard
                    ]
                ];
            }
        }

        return $result;
    }

    // ########################################

    /**
     * @return int
     */
    public function getChatId(): int
    {
        return $this->chatId;
    }

    /**
     * @param int $chatId
     */
    public function setChatId(int $chatId): void
    {
        $this->chatId = $chatId;
    }

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
     * @return string
     */
    public function getParseMode(): string
    {
        return $this->parseMode;
    }

    public function setParseMarkdownMode(): void
    {
        $this->parseMode = self::MARKDOWN_PARSE_MODE;
    }

    public function setParseHtmlMode(): void
    {
        $this->parseMode = self::HTML_PARSE_MODE;
    }

    public function setParseDefaultMode(): void
    {
        $this->parseMode = null;
    }

    // ########################################

    /**
     * @return bool
     */
    public function isDisableWebPagePreview(): bool
    {
        return $this->disableWebPagePreview;
    }

    /**
     * @param bool $disableWebPagePreview
     */
    public function setDisableWebPagePreview(bool $disableWebPagePreview): void
    {
        $this->disableWebPagePreview = $disableWebPagePreview;
    }

    /**
     * @return bool
     */
    public function isDisableNotification(): bool
    {
        return $this->disableNotification;
    }

    /**
     * @param bool $disableNotification
     */
    public function setDisableNotification(bool $disableNotification): void
    {
        $this->disableNotification = $disableNotification;
    }

    /**
     * @return int
     */
    public function getReplyToMessageId(): int
    {
        return $this->replyToMessageId;
    }

    /**
     * @param int $replyToMessageId
     */
    public function setReplyToMessageId(int $replyToMessageId): void
    {
        $this->replyToMessageId = $replyToMessageId;
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

    /**
     * @return bool
     */
    public function hasReplyMarkup(): bool
    {
        return !is_null($this->replyMarkup);
    }

    /**
     * @return bool
     */
    public function isReplyMarkupInlineKeyboardMarkup(): bool
    {
        if (!$this->hasReplyMarkup()) {
            return false;
        }

        return $this->replyMarkup instanceof \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup;
    }

    /**
     * @return bool
     */
    public function isReplyMarkupReplyKeyboardMarkup(): bool
    {
        if (!$this->hasReplyMarkup()) {
            return false;
        }

        return $this->replyMarkup instanceof \App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardMarkup;
    }

    /**
     * @return bool
     */
    public function isReplyMarkupReplyReplyKeyboardRemove(): bool
    {
        if (!$this->hasReplyMarkup()) {
            return false;
        }

        return $this->replyMarkup instanceof \App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardRemove;
    }

    /**
     * @return bool
     */
    public function isReplyMarkupReplyForceReply(): bool
    {
        if (!$this->hasReplyMarkup()) {
            return false;
        }

        return $this->replyMarkup instanceof \App\Telegram\Model\Type\ReplyMarkup\ForceReply;
    }

    // ########################################
}
