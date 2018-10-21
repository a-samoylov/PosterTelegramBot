<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Command\ActionCommand\Commands;

class RemoveItem extends \App\Command\ActionCommand\BaseAbstract
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

    /**
     * @var \App\Repository\Telegram\UserRepository
     */
    private $userRepository;
    // ########################################

    public function __construct(
        \App\Repository\Telegram\LayoutRepository                                              $layoutRepository,
        \App\Telegram\Model\Methods\Edit\Message\Factory                                       $editMessageFactory,
        \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\Factory                      $inlineKeyboardMarkupFactory,
        \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\InlineKeyboardButton\Factory $inlineKeyboardButtonFactory,
        \App\Repository\Telegram\UserRepository $userRepository
    ) {
        $this->layoutRepository            = $layoutRepository;
        $this->editMessageFactory          = $editMessageFactory;
        $this->inlineKeyboardMarkupFactory = $inlineKeyboardMarkupFactory;
        $this->inlineKeyboardButtonFactory = $inlineKeyboardButtonFactory;
        $this->userRepository              = $userRepository;
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
        $layout = $this->layoutRepository->findOneBy(['layoutId' => $params['layout_id']]);
        if (is_null($layout)) {
            return;
        }

        $orders = $user->getOrders();

        if (!isset($orders[$params['item_id']])) {
            $count = 1;
            $orders[$params['item_id']] = $count;
        } else {
            $count = $orders[$params['item_id']];
            $count--;
            $orders[$params['item_id']] = $count;
        }

        $layout->setText("Количество {$count}");

        $editMessageModel = $this->editMessageFactory->create($user->getChat()->getId(), $layout->getBot(), $user->getLastMessageId(), $layout->getText());

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

                $editMessageModel->setReplyMarkup($inlineKeyboardMarkup);
            }
        }

        $message = $editMessageModel->send();
        $user->setLastMessageId((int)$message['message_id']);
        $this->userRepository->save($user);
    }

    // ########################################
}
