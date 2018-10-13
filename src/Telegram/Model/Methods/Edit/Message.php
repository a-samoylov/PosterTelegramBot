<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Methods\Edit;

class Message extends \App\Telegram\Model\Methods\BaseAbstract
{
    // ########################################

    /**
     * @var int
     */
    private $chatId;

    /**
     * @var string
     */
    private $messageId;

    /**
     * @var string
     */
    private $inlineMessageId;

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
     * @var \App\Telegram\Model\Type\ReplyMarkup\BaseAbstract
     */
    private $replyMarkup;

    // ########################################

    /**
     * @param int    $chatId
     * @param int    $messageId
     * @param string $text
     */
    public function __construct(int $chatId, int $messageId, string $text)
    {
        $this->chatId    = $chatId;
        $this->text      = $text;
        $this->messageId = $messageId;
    }

    // ########################################

    protected function getMethodName(): string
    {
        return 'editMessageText';
    }

    protected function getRequestParams(): array
    {
        $result = [
            'chat_id'    => $this->chatId,
            'message_id' => $this->messageId,
            'text'       => $this->text,
        ];

        if ($this->hasReplyMarkup()) {
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
            }

            $result['reply_markup'] = [
                'inline_keyboard' => [
                    $inlineKeyboard
                ]
            ];
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

    // ########################################

    /**
     * @return string
     */
    public function getMessageId(): string
    {
        return $this->messageId;
    }

    /**
     * @param string $messageId
     */
    public function setMessageId(string $messageId): void
    {
        $this->messageId = $messageId;
    }

    // ########################################

    /**
     * @return string
     */
    public function getInlineMessageId(): string
    {
        return $this->inlineMessageId;
    }

    /**
     * @param string $inlineMessageId
     */
    public function setInlineMessageId(string $inlineMessageId): void
    {
        $this->inlineMessageId = $inlineMessageId;
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
     * @return string
     */
    public function getParseMode(): string
    {
        return $this->parseMode;
    }

    /**
     * @param string $parseMode
     */
    public function setParseMode(string $parseMode): void
    {
        $this->parseMode = $parseMode;
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

    // ########################################

    /**
     * @return bool
     */
    public function hasReplyMarkup(): bool
    {
        return !is_null($this->replyMarkup);
    }

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
