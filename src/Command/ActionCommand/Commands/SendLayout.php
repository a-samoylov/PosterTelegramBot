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

    private $replyKeyboardMarkupFactory;

    private $replyKeyboardButtonFactory;

    // ########################################

    public function __construct(
        \App\Repository\Telegram\LayoutRepository $layoutRepository,
        \App\Telegram\Model\Methods\Send\Message\Factory $sendMessageFactory,
        \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\Factory $inlineKeyboardMarkupFactory,
        \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\InlineKeyboardButton\Factory $inlineKeyboardButtonFactory,
        \App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardMarkup\Factory $replyKeyboardMarkupFactory,
        \App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardMarkup\KeyboardButton\Factory $replyKeyboardButtonFactory
    ) {
        $this->layoutRepository            = $layoutRepository;
        $this->sendMessageFactory          = $sendMessageFactory;
        $this->inlineKeyboardMarkupFactory = $inlineKeyboardMarkupFactory;
        $this->inlineKeyboardButtonFactory = $inlineKeyboardButtonFactory;
        $this->replyKeyboardMarkupFactory  = $replyKeyboardMarkupFactory;
        $this->replyKeyboardButtonFactory  = $replyKeyboardButtonFactory;
    }

    // ########################################

    /**
     * @param \App\Telegram\Model\Type\Update\BaseAbstract $update
     * @param array                                        $params
     *
     * @return string|bool
     */
    public function validate(\App\Telegram\Model\Type\Update\BaseAbstract $update, array $params)
    {
        if (!isset($params['layout_id'])) {
            return 'Invalid param layout_id';
        }

        return true;
    }

    // ########################################

    public function processCommand(\App\Telegram\Model\Type\Update\BaseAbstract $update, \App\Entity\Telegram\User $user, array $params): void {
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
            } else {
                if ($replyMarkup['type'] === \App\Telegram\Bot\BotGenerator\Settings::TYPE_REPLY_KEYBOARD_MARKUP) {
                    $replyKeyboardMarkup = $this->replyKeyboardMarkupFactory->create();

                    foreach ($replyMarkup['buttons'] as $buttonsRow) {
                        $row = [];
                        foreach ($buttonsRow as $inlineButton) {
                            $row[] = $this->replyKeyboardButtonFactory->create($inlineButton['text']);
                        }

                        $replyKeyboardMarkup->addKeyboardButtonRow($row);
                    }

                    $sendMessageModel->setReplyMarkup($replyKeyboardMarkup);
                }
            }
        }

        $sendMessageModel->send();
    }

    // ########################################
}
