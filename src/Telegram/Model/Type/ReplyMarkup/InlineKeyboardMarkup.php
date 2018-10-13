<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\ReplyMarkup;

class InlineKeyboardMarkup extends BaseAbstract
{
    // ########################################

    /**
     * Array of button rows, each represented by an Array of InlineKeyboardButton objects
     *
     * @var \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\InlineKeyboardButton[]
     */
    protected $inlineKeyboard;

    // ########################################

    /**
     * InlineKeyboardMarkup constructor.
     */
    public function __construct()
    {
        $this->inlineKeyboard = [];
    }

    // ########################################

    /**
     * @return array[]
     */
    public function getInlineKeyboardRows(): array
    {
        return $this->inlineKeyboard;
    }

    /**
     * @param \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\InlineKeyboardButton[] $inlineKeyboard
     */
    public function addRowInlineKeyboard(array $inlineKeyboard): void
    {
        $this->inlineKeyboard[] = $inlineKeyboard;
    }

    // ########################################
}
