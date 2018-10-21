<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Bot\BotGenerator\Settings\Command;

class Factory
{
    // ########################################

    public function create(string $name, array $action): \App\Telegram\Bot\BotGenerator\Settings\Command
    {
        return new \App\Telegram\Bot\BotGenerator\Settings\Command($name, $action);
    }

    // ########################################
}
