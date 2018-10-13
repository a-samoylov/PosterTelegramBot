<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup;

use App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup;

class Factory
{
    // ########################################

    /**
     * @return \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup
     */
    public function create(): InlineKeyboardMarkup
    {
        return new InlineKeyboardMarkup();
    }

    // ########################################
}
