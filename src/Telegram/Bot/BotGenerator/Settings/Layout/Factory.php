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
        return new \App\Telegram\Bot\BotGenerator\Settings\Layout(
            $data['id'],
            $data['name'],
            $data['text']
        );
    }

    // ########################################
}
