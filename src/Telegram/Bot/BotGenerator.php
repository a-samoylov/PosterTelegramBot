<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Bot;

class BotGenerator
{
    /**
     * @var \App\Telegram\Bot\BotGenerator\Settings\Factory
     */
    private $settingsFactory;

    // ########################################

    public function __construct(\App\Telegram\Bot\BotGenerator\Settings\Factory $settingsFactory)
    {
        $this->settingsFactory = $settingsFactory;
    }

    // ########################################

    public function generate(\App\Entity\Telegram\Bot $bot)
    {
        $settings = $this->settingsFactory->create($bot);

        $a = 2;

    }

    // ########################################
}
