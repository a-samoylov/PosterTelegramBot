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
    public const COMMAND_EDIT_LAYOUT = ['edit_layout' => 'telegram.action.command.edit.message'];

    // ########################################

    public function resolve(string $commandName)
    {
        $actionsSettings = [
            self::COMMAND_OPEN_LAYOUT,
            self::COMMAND_EDIT_LAYOUT,
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
