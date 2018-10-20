<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Bot;

class Helper
{
    /**
     * @var \App\Telegram\Model\Methods\Send\Message\Factory
     */
    private $sendMessageFactory;

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
        \App\Telegram\Model\Methods\Send\Message\Factory                                       $sendMessageFactory,
        \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\Factory                      $inlineKeyboardMarkupFactory,
        \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\InlineKeyboardButton\Factory $inlineKeyboardButtonFactory
    ) {
        $this->sendMessageFactory          = $sendMessageFactory;
        $this->inlineKeyboardMarkupFactory = $inlineKeyboardMarkupFactory;
        $this->inlineKeyboardButtonFactory = $inlineKeyboardButtonFactory;
    }

    // ########################################

    public function sendLayout(
        \App\Entity\Telegram\User   $user,
        \App\Entity\Telegram\Layout $layout
    ) {
        $sendMessageModel = $this->sendMessageFactory->create($user->getChat()->getId(), $layout->getText());

        $replyMarkup = $layout->getReplyMarkup();
        if (!empty($replyMarkup)) {
            if ($replyMarkup['type'] === \App\Telegram\Bot\BotGenerator\Settings::TYPE_REPLY_INLINE_KEYBOARD_MARKUP) {
                $inlineKeyboardMarkup = $this->inlineKeyboardMarkupFactory->create();

                foreach ($replyMarkup['buttons'] as $buttonsRow) {
                    $row = [];
                    foreach ($buttonsRow as $inlineButton) {
                        $row[] = $this->inlineKeyboardButtonFactory->create($inlineButton['text'], json_encode([
                            'bot' => $layout->getBot()->getId(),
                            'btn' => $inlineButton['id']
                        ]));
                    }

                    $inlineKeyboardMarkup->addRowInlineKeyboard($row);
                }

                $sendMessageModel->setReplyMarkup($inlineKeyboardMarkup);
            }
        }

        $sendMessageModel->send();
    }

    // ########################################
}
