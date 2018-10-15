<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Bot\BotGenerator\Settings;

class Factory
{
    /**
     * @var \App\Telegram\Bot\BotGenerator\Settings\Layout\Factory
     */
    private $layoutFactory;

    // ########################################

    public function __construct(\App\Telegram\Bot\BotGenerator\Settings\Layout\Factory $layoutFactory)
    {
        $this->layoutFactory = $layoutFactory;
    }

    public function create(array $data): \App\Telegram\Bot\BotGenerator\Settings
    {
        if (empty($data['layouts'])) {
            throw new \App\Model\Exception\Validate(self::class, 'layouts', $data);
        }

        $result = new \App\Telegram\Bot\BotGenerator\Settings();

        foreach ($data['layouts'] as $layoutData) {
            $result->addLayout($this->layoutFactory->create($layoutData));
        }

        return $result;
    }

    // ########################################
}
