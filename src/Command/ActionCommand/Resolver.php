<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Command\ActionCommand;

class Resolver
{
    public const COMMAND_OPEN_LAYOUT = ['open_layout' => 'telegram.action.command.send.message'];

    // ########################################

    public function resolve(string $commandName)
    {
        $actionsSettings = [
            self::COMMAND_OPEN_LAYOUT
        ];

        foreach ($actionsSettings as $actionsSetting) {
            foreach ($actionsSetting as $command => $serviceName) {
                if ($command === $commandName) {
                    return $serviceName;
                }
            }
        }

        return null;
    }

    // ########################################
}
