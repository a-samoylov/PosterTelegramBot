<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Command\ActionCommand\Commands;

class SendLayout extends \App\Command\ActionCommand\BaseAbstract
{

    /**
     * @var \App\Repository\Telegram\LayoutRepository
     */
    private $layoutRepository;

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
        \App\Repository\Telegram\LayoutRepository                                              $layoutRepository,
        \App\Telegram\Model\Methods\Send\Message\Factory                                       $sendMessageFactory,
        \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\Factory                      $inlineKeyboardMarkupFactory,
        \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\InlineKeyboardButton\Factory $inlineKeyboardButtonFactory
    ) {
        $this->layoutRepository            = $layoutRepository;
        $this->sendMessageFactory          = $sendMessageFactory;
        $this->inlineKeyboardMarkupFactory = $inlineKeyboardMarkupFactory;
        $this->inlineKeyboardButtonFactory = $inlineKeyboardButtonFactory;
    }

    // ########################################

    /**
     * @param array $params
     *
     * @return string|bool
     */
    public function validate(array $params)
    {
        if (!isset($params['layout_id'])) {
            return 'Invalid param layout_id';
        }

        return true;
    }

    // ########################################

    public function processCommand(\App\Entity\Telegram\User $user, array $params): void
    {
        $layout = $this->layoutRepository->findOneBy(['layoutId' => $params['layout_id']]);
        if (is_null($layout)) {
            return;
        }

        $sendMessageModel = $this->sendMessageFactory->create($user, $layout->getBot(), $layout->getText());

        $replyMarkup = $layout->getReplyMarkup();
        if (!empty($replyMarkup)) {
            if ($replyMarkup['type'] === \App\Telegram\Bot\BotGenerator\Settings::TYPE_REPLY_INLINE_KEYBOARD_MARKUP) {
                $inlineKeyboardMarkup = $this->inlineKeyboardMarkupFactory->create();

                foreach ($replyMarkup['buttons'] as $buttonsRow) {
                    $row = [];
                    foreach ($buttonsRow as $inlineButton) {
                        $row[] = $this->inlineKeyboardButtonFactory->create($inlineButton['text'], json_encode([
                            'lt'  => $layout->getId(),
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
