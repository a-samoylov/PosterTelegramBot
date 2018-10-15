<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Bot\BotGenerator\Settings;

class Layout
{
    // ########################################

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $text;

    // ########################################

    /**
     * @param int    $id
     * @param string $name
     * @param string $text
     */
    public function __construct(int $id, string $name, string $text)
    {
        $this->id   = $id;
        $this->name = $name;
        $this->text = $text;
    }

    // ########################################
}
