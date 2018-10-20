<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Bot\BotGenerator\Settings\Layout;

class Factory
{
    // ########################################

    public function create(array $data): \App\Telegram\Bot\BotGenerator\Settings\Layout
    {
        //todo validate

        $result = new \App\Telegram\Bot\BotGenerator\Settings\Layout(
            $data['id'],
            $data['name'],
            $data['text']
        );

        $replyMarkup = $data['reply_markup'];
        if ($replyMarkup['type'] === \App\Telegram\Bot\BotGenerator\Settings::TYPE_REPLY_INLINE_KEYBOARD_MARKUP) {
            $result->setReplyMarkup($replyMarkup);

            return $result;
        }

        if ($replyMarkup['type'] === \App\Telegram\Bot\BotGenerator\Settings::TYPE_REPLY_KEYBOARD_MARKUP) {
        }

        return $result;
    }

    // ########################################
}
