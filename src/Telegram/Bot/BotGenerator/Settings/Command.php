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

    /** @var integer */
    private $layoutId;

    // ########################################

    /**
     * @param string $name
     * @param int    $layoutId
     */
    public function __construct(string $name, int $layoutId)
    {
        $this->name     = $name;
        $this->layoutId = $layoutId;
    }

    // ########################################

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getLayoutId(): int
    {
        return $this->layoutId;
    }

    // ########################################
}
