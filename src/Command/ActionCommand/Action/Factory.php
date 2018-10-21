<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Command\Process\ActionCommand\Action;

class Factory
{
    // ########################################

    public function create(array $data): \App\Command\ActionCommand\Action
    {
        //validate
        return new \App\Command\ActionCommand\Action($data['command'], $data['params']);
    }

    // ########################################
}
