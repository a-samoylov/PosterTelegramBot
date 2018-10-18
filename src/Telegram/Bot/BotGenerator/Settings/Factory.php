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
     * @var \App\Repository\Telegram\LayoutRepository
     */
    private $layoutRepository;

    // ########################################

    public function __construct(\App\Repository\Telegram\LayoutRepository $layoutRepository)
    {
        $this->layoutRepository = $layoutRepository;
    }

    public function create(array $data): \App\Telegram\Bot\BotGenerator\Settings
    {
        if (empty($data['layouts'])) {
            throw new \App\Model\Exception\Validate(self::class, 'layouts', $data);
        }

        $layoutsData = $data['layouts'];
        foreach ($layoutsData as $layoutData) {
            if (!isset($layoutData['name']) || !is_string($layoutData['name'])) {
                throw new \App\Model\Exception\Validate(self::class, 'name', $data);
            }

            if (!isset($layoutData['text']) || !is_string($layoutData['text'])) {
                throw new \App\Model\Exception\Validate(self::class, 'text', $data);
            }

            if (!isset($layoutData['reply_markup'])) {
                throw new \App\Model\Exception\Validate(self::class, 'reply_markup', $data);
            }
        }

        //todo validate other

        $result = new \App\Telegram\Bot\BotGenerator\Settings();

        foreach ($layoutsData as $layoutData) {
            $result->addLayout($this->layoutRepository->create($layoutData['name'], $layoutData['text']));
        }

        return $result;
    }

    // ########################################
}
