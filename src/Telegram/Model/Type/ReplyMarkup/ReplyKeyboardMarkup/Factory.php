<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardMarkup;

class Factory
{
    // ########################################

    /**
     * @param bool $resizeKeyboard
     * @param bool $oneTimeKeyboard
     * @param bool $selective
     *
     * @return \App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardMarkup
     */
    public function create(
        bool $resizeKeyboard = false,
        bool $oneTimeKeyboard = false,
        bool $selective = false
    ): \App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardMarkup {
        return new \App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardMarkup(
            $resizeKeyboard,
            $oneTimeKeyboard,
            $selective
        );
    }

    // ########################################
}
