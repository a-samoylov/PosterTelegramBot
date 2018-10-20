<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Bot\BotGenerator\Settings\Relationship;

class Factory
{
    // ########################################

    public function create(
        int $layoutId,
        int $buttonId,
        string $action,
        int $anotherId
    ): \App\Telegram\Bot\BotGenerator\Settings\Relationship {
        if (!in_array($action, [
            \App\Telegram\Bot\BotGenerator\Settings\Relationship::ACTION_OPEN_LAYOUT,
            \App\Telegram\Bot\BotGenerator\Settings\Relationship::ACTION_EDIT_LAYOUT,
        ])) {
            throw new \App\Model\Exception\Validate(self::class, 'action', $action);
        }

        //todo validate( check is exist data)

        return new \App\Telegram\Bot\BotGenerator\Settings\Relationship(
            $layoutId,
            $buttonId,
            $action,
            $anotherId
        );
    }

    // ########################################
}
