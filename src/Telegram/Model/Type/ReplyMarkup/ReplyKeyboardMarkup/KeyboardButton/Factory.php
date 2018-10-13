<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardMarkup\KeyboardButton;

class Factory
{
    // ########################################

    public function create(
        string $text,
        bool $requestContact = false,
        bool $requestLocation = false
    ): \App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardMarkup\KeyboardButton {
        return new \App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardMarkup\KeyboardButton($text, $requestContact, $requestLocation);
    }

    // ########################################
}
