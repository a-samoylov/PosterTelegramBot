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

    /**
     * @var \App\Repository\Telegram\LayoutRepository
     */
    private $layoutRepository;

    // ########################################

    public function __construct(
        \App\Telegram\Bot\BotGenerator\Settings\Factory $settingsFactory,
        \App\Repository\Telegram\LayoutRepository       $layoutRepository
    ) {
        $this->settingsFactory  = $settingsFactory;
        $this->layoutRepository = $layoutRepository;
    }

    // ########################################

    public function generate(\App\Entity\Telegram\Bot $bot)
    {
        $settings = $this->settingsFactory->create($bot);

        foreach ($settings->getLayouts() as $layout) {
            $this->layoutRepository->create($layout);
        }


    }

    // ########################################
}
