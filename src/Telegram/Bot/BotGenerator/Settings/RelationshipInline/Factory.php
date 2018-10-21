<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Bot\BotGenerator\Settings\RelationshipInline;

class Factory
{
    // ########################################

    public function create(
        int $layoutId,
        int $buttonId,
        array $action
    ): \App\Telegram\Bot\BotGenerator\Settings\RelationshipInline {
        //todo validate( check is exist data)

        return new \App\Telegram\Bot\BotGenerator\Settings\RelationshipInline($layoutId, $buttonId, $action);
    }

    // ########################################
}
