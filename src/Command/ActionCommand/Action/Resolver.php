<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Command\Process\CallbackMessageCommands\Action;

class Resolver
{
    public const TYPE_OPEN_LAYOUT = 'open_layout';

    // ########################################

    public function resolve(string $actionType)
    {
        if ($actionType === self::TYPE_OPEN_LAYOUT) {
            return '';
        }

        return null;
    }

    // ########################################
}
