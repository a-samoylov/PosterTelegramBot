<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Bot\BotGenerator;

class Settings
{
    /** @var \App\Entity\Telegram\Layout[] */
    private $layouts;

    // ########################################

    /**
     * @return \App\Entity\Telegram\Layout[]
     */
    public function getLayouts(): array
    {
        return $this->layouts;
    }

    /**
     * @param \App\Entity\Telegram\Layout $layout
     */
    public function addLayout(\App\Entity\Telegram\Layout $layout): void
    {
        $this->layouts[] = $layout;
    }

    // ########################################
}
