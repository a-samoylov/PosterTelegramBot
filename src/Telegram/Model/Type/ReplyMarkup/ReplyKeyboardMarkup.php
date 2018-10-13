<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\ReplyMarkup;

class ReplyKeyboardMarkup extends BaseAbstract
{
    // ########################################

    /**
     * Array of button rows, each represented by an Array of Strings
     * Array of Array of String
     *
     * @var \App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardMarkup\KeyboardButton[]
     */
    protected $keyboardButtonsRows;

    /**
     * Optional. Requests clients to resize the keyboard vertically for optimal fit
     * (e.g., make the keyboard smaller if there are just two rows of buttons).
     * Defaults to false, in which case the custom keyboard is always of the same height as the app's standard keyboard.
     *
     * @var bool
     */
    protected $resizeKeyboard;

    /**
     * Optional. Requests clients to hide the keyboard as soon as it's been used. Defaults to false.
     *
     * @var bool
     */
    protected $oneTimeKeyboard;

    /**
     * Optional. Use this parameter if you want to show the keyboard to specific users only.
     * Targets:
     * 1) users that are @mentioned in the text of the Message object;
     * 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     *
     * @var bool
     */
    protected $selective;

    // ########################################

    /**
     * ReplyKeyboardMarkup constructor.
     *
     * @param bool $resizeKeyboard
     * @param bool $oneTimeKeyboard
     * @param bool $selective
     */
    public function __construct(
        bool $resizeKeyboard,
        bool $oneTimeKeyboard,
        bool $selective
    ) {
        $this->resizeKeyboard  = $resizeKeyboard;
        $this->oneTimeKeyboard = $oneTimeKeyboard;
        $this->selective       = $selective;
    }

    // ########################################

    /**
     * @param \App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardMarkup\KeyboardButton[] $keyboardButton
     */
    public function addKeyboardButtonRow(array $keyboardButton)
    {
        $this->keyboardButtonsRows[] = $keyboardButton;
    }

    /**
     * @return array[]
     */
    public function getKeyboardButtonsRows(): array
    {
        return $this->keyboardButtonsRows;
    }

    /**
     * @param \App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardMarkup\KeyboardButton[] $keyboardButtonsRows
     */
    public function setKeyboardButtonsRows(array $keyboardButtonsRows): void
    {
        $this->keyboardButtonsRows = $keyboardButtonsRows;
    }

    // ########################################

    /**
     * @return bool
     */
    public function isResizeKeyboard(): bool
    {
        return $this->resizeKeyboard;
    }

    /**
     * @param bool $resizeKeyboard
     */
    public function setResizeKeyboard(bool $resizeKeyboard): void
    {
        $this->resizeKeyboard = $resizeKeyboard;
    }

    /**
     * @return bool
     */
    public function isOneTimeKeyboard(): bool
    {
        return $this->oneTimeKeyboard;
    }

    /**
     * @param bool $oneTimeKeyboard
     */
    public function setOneTimeKeyboard(bool $oneTimeKeyboard): void
    {
        $this->oneTimeKeyboard = $oneTimeKeyboard;
    }

    /**
     * @return bool
     */
    public function isSelective(): bool
    {
        return $this->selective;
    }

    /**
     * @param bool $selective
     */
    public function setSelective(bool $selective): void
    {
        $this->selective = $selective;
    }

    // ########################################
}
