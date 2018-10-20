<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Bot\BotGenerator\Settings\Layout;

class Factory
{
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
        \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\Factory                      $inlineKeyboardMarkupFactory,
        \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\InlineKeyboardButton\Factory $inlineKeyboardButtonFactory
    ) {
        $this->inlineKeyboardMarkupFactory = $inlineKeyboardMarkupFactory;
        $this->inlineKeyboardButtonFactory = $inlineKeyboardButtonFactory;
    }

    // ########################################

    public function create(\App\Entity\Telegram\Bot $bot, array $data): \App\Telegram\Bot\BotGenerator\Settings\Layout
    {
        //todo validate

        $result = new \App\Telegram\Bot\BotGenerator\Settings\Layout(
            $bot,
            $data['id'],
            $data['name'],
            $data['text']
        );

        $replyMarkup = $data['reply_markup'];
        if ($replyMarkup['type'] === \App\Telegram\Bot\BotGenerator\Settings::TYPE_REPLY_INLINE_KEYBOARD_MARKUP) {
            $inlineKeyboardMarkup = $this->inlineKeyboardMarkupFactory->create();

            $rowInlineKeyboard = [];
            foreach ($replyMarkup['buttons'] as $buttonsRow) {
                $row = [];
                foreach ($buttonsRow as $inlineKeyboardButtonData) {
                    $row[] = $this->inlineKeyboardButtonFactory->create($inlineKeyboardButtonData['text'], json_encode([
                        'action'    => $inlineKeyboardButtonData['action'],
                        'layout_id' => $inlineKeyboardButtonData['layout_id'],
                    ]));
                }

                !empty($row) && $rowInlineKeyboard[] = $row;
            }

            !empty($rowInlineKeyboard) && $inlineKeyboardMarkup->addRowInlineKeyboard($rowInlineKeyboard);

            $result->setReplyMarkup($inlineKeyboardMarkup);

            return $result;
        }

        if ($replyMarkup['type'] === \App\Telegram\Bot\BotGenerator\Settings::TYPE_REPLY_KEYBOARD_MARKUP) {
        }

        return $result;
    }

    // ########################################
}
