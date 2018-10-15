<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Bot\BotGenerator;

class Settings
{
    /** @var \App\Telegram\Bot\BotGenerator\Settings\Layout[] */
    private $layouts;

    // ########################################

    /**
     * @return \App\Telegram\Bot\BotGenerator\Settings\Layout[]
     */
    public function getLayouts(): array
    {
        return $this->layouts;
    }

    /**
     * @param \App\Telegram\Bot\BotGenerator\Settings\Layout $layout
     */
    public function addLayout(\App\Telegram\Bot\BotGenerator\Settings\Layout $layout): void
    {
        $this->layouts[] = $layout;
    }

    // ########################################
}
