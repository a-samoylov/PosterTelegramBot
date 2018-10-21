<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Bot\BotGenerator\Settings;

class Command
{
    // ########################################

    /** @var string */
    private $name;

    /** @var array */
    private $action;

    // ########################################

    public function __construct(string $name, array $action)
    {
        $this->name   = $name;
        $this->action = $action;
    }

    // ########################################

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function getAction(): array
    {
        return $this->action;
    }

    // ########################################
}
