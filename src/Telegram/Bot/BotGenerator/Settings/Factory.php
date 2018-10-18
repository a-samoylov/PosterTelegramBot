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

    /**
     * @var \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\Factory
     */
    private $inlineKeyboardMarkupFactory;

    /**
     * @var \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\InlineKeyboardButton\Factory
     */
    private $inlineKeyboardButtonFactory;

    // ########################################

    public function __construct(
        \App\Repository\Telegram\LayoutRepository                                              $layoutRepository,
        \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\Factory                      $inlineKeyboardMarkupFactory,
        \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\InlineKeyboardButton\Factory $inlineKeyboardButtonFactory
    ) {
        $this->layoutRepository            = $layoutRepository;
        $this->inlineKeyboardMarkupFactory = $inlineKeyboardMarkupFactory;
        $this->inlineKeyboardButtonFactory = $inlineKeyboardButtonFactory;
    }

    // ########################################

    public function create(\App\Entity\Telegram\Bot $bot): \App\Telegram\Bot\BotGenerator\Settings
    {
        $data = $bot->getSettings();
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
            $replayMarkup = $layoutData['reply_markup'];
            if ($replayMarkup['type'] === \App\Telegram\Bot\BotGenerator\Settings::REPLY_INLINE_KEYBOARD_MARKUP) {
                $inlineKeyboardMarkup = $this->inlineKeyboardMarkupFactory->create();

                $rowInlineKeyboard = [];
                foreach ($replayMarkup['buttons'] as $inlineKeyboardButtonData) {
                    $rowInlineKeyboard[] = $this->inlineKeyboardButtonFactory->create($inlineKeyboardButtonData['text'], '');
                }

                !empty($rowInlineKeyboard) && $inlineKeyboardMarkup->addRowInlineKeyboard($rowInlineKeyboard);
            }

            $result->addLayout($this->layoutRepository->create($bot, $layoutData['name'], $layoutData['text'], []));
        }

        return $result;
    }

    // ########################################
}
