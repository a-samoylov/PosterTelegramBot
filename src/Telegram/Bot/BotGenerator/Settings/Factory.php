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

    /**
     * @var \App\Telegram\Bot\BotGenerator\Settings\Relationship\Factory
     */
    private $relationshipFactory;

    /**
     * @var \App\Telegram\Bot\BotGenerator\Settings\Command\Factory
     */
    private $commandFactory;

    // ########################################

    public function __construct(
        \App\Telegram\Bot\BotGenerator\Settings\Layout\Factory       $layoutFactory,
        \App\Telegram\Bot\BotGenerator\Settings\Relationship\Factory $relationshipFactory,
        \App\Telegram\Bot\BotGenerator\Settings\Command\Factory      $commandFactory
    ) {
        $this->layoutFactory       = $layoutFactory;
        $this->relationshipFactory = $relationshipFactory;
        $this->commandFactory      = $commandFactory;
    }

    // ########################################

    public function create(\App\Entity\Telegram\Bot $bot): \App\Telegram\Bot\BotGenerator\Settings
    {
        $data = $bot->getSettings();
        if (empty($data['layouts'])) {
            throw new \App\Model\Exception\Validate(self::class, 'layouts', $data);
        }

        $layoutsData       = $data['layouts'];
        $relationshipsData = $data['relationship'];
        $commandsData      = $data['commands'];
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

        $result = new \App\Telegram\Bot\BotGenerator\Settings($bot);

        foreach ($layoutsData as $layoutData) {
            $result->addLayout($this->layoutFactory->create($layoutData));
        }

        foreach ($relationshipsData as $relationshipData) {
            $result->addRelationship($this->relationshipFactory->create(
                $relationshipData['layout_id'],
                $relationshipData['button_id'],
                $relationshipData['action'],
                $relationshipData['another_layout_id']
            ));
        }

        foreach ($commandsData as $commandData) {
            $result->addCommand($this->commandFactory->create($commandData['name'], $commandData['layout_id']));
        }

        return $result;
    }

    // ########################################
}
