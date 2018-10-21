<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Bot\BotGenerator\Settings\RelationshipKeyboard;

class Factory
{
    // ########################################

    public function create(
        int $layoutId,
        string $buttonText,
        array $action
    ): \App\Telegram\Bot\BotGenerator\Settings\RelationshipKeyboard {
        //todo validate( check is exist data)

        return new \App\Telegram\Bot\BotGenerator\Settings\RelationshipKeyboard($layoutId, $buttonText, $action);
    }

    // ########################################
}
