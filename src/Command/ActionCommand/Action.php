<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Command\ActionCommand;

class Action
{
    /** @var string */
    private $command;

    /** @var array */
    private $params;

    // ########################################

    /**
     * @param string $command
     * @param array  $params
     */
    public function __construct(string $command, array $params)
    {
        $this->command = $command;
        $this->params  = $params;
    }

    // ########################################

    /**
     * @return string
     */
    public function getCommand(): string
    {
        return $this->command;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    // ########################################
}
