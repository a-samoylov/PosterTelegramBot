<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Command\ActionCommand\Commands;

class EditLayout extends \App\Command\ActionCommand\BaseAbstract
{
    /**
     * @var \App\Repository\Telegram\LayoutRepository
     */
    private $layoutRepository;

    /**
     * @var \App\Telegram\Model\Methods\Edit\Message\Factory
     */
    private $editMessageFactory;

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
        \App\Telegram\Model\Methods\Edit\Message\Factory                                       $editMessageFactory,
        \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\Factory                      $inlineKeyboardMarkupFactory,
        \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\InlineKeyboardButton\Factory $inlineKeyboardButtonFactory
    ) {
        $this->layoutRepository            = $layoutRepository;
        $this->editMessageFactory          = $editMessageFactory;
        $this->inlineKeyboardMarkupFactory = $inlineKeyboardMarkupFactory;
        $this->inlineKeyboardButtonFactory = $inlineKeyboardButtonFactory;
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
        if (!$update instanceof \App\Telegram\Model\Type\Update\CallbackQuery) {
            return 'Invalid update type';
        }

        if (!isset($params['layout_id'])) {
            return 'Invalid param layout_id';
        }

        return true;
    }

    // ########################################

    public function processCommand(\App\Telegram\Model\Type\Update\BaseAbstract $update, \App\Entity\Telegram\User $user, array $params): void
    {
        /** @var \App\Telegram\Model\Type\Update\CallbackQuery $callbackQuery */
        $callbackQuery = $update;

        $layout = $this->layoutRepository->findOneBy(['layoutId' => $params['layout_id']]);
        if (is_null($layout)) {
            return;
        }

        $editMessageModel = $this->editMessageFactory->create($callbackQuery->getChatInstance()$user, $layout->getBot(), $layout->getText());

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
