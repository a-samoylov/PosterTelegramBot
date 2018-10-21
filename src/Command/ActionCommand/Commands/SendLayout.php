<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Command\ActionCommand\Commands;

class SendLayout extends \App\Command\ActionCommand\BaseAbstract
{
    // ########################################

    /**
     * @param array $params
     *
     * @return string|bool
     */
    public function validate(array $params)
    {
        return true;
    }

    // ########################################

    public function processCommand(array $params): void
    {
        $a = 2;
        // TODO: Implement processCommand() method.
    }

    // ########################################
}
