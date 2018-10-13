<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Command\Register;

class StartStep extends \App\Command\BaseAbstract
{
    public const CALLBACK_STEP_NAME = 'start_step_callback';

    /**
     * @var \App\Telegram\Model\Methods\Send\Message\Factory
     */
    private $sendMessageFactory;

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
     * @var \App\Repository\Telegram\ChatRepository
     */
    private $telegramChatRepository;

    /**
     * @var \App\Repository\UserRepository
     */
    private $userRepository;

    /**
     * @var \App\Model\Helper\DateTime
     */
    private $dateTimeHelper;

    // ########################################

    public function __construct(
        \App\Telegram\Model\Methods\Send\Message\Factory                                       $sendMessageFactory,
        \App\Telegram\Model\Methods\Edit\Message\Factory                                       $editMessageFactory,
        \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\Factory                      $inlineKeyboardMarkupFactory,
        \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\InlineKeyboardButton\Factory $inlineKeyboardButtonFactory,
        \App\Repository\Telegram\ChatRepository                                                $telegramChatRepository,
        \App\Repository\UserRepository                                                         $userRepository,
        \App\Model\Helper\DateTime                                                             $dateTimeHelper
    ) {
        $this->sendMessageFactory          = $sendMessageFactory;
        $this->editMessageFactory          = $editMessageFactory;
        $this->inlineKeyboardMarkupFactory = $inlineKeyboardMarkupFactory;
        $this->inlineKeyboardButtonFactory = $inlineKeyboardButtonFactory;
        $this->telegramChatRepository      = $telegramChatRepository;
        $this->userRepository              = $userRepository;
        $this->dateTimeHelper              = $dateTimeHelper;
    }

    // ########################################

    /**
     * @return string|bool
     */
    public function validate()
    {
        if (!$this->getUpdate()->isCallbackQuery() && !$this->getUpdate()->isMessageUpdate()) {
            return 'Wrong update type.';
        }

        if ($this->getUpdate() instanceof \App\Telegram\Model\Type\Update\MessageUpdate) {
            /**
             * @var \App\Telegram\Model\Type\Update\MessageUpdate $update
             */
            $update = $this->getUpdate();

            $userEntity = $this->userRepository->find($update->getMessage()->getChat()->getId());
            if (!is_null($userEntity)) {
                return 'User already exist. Can\'t run start step.';
            }
        }

        return true;
    }

    // ########################################

    public function processCommand(): void
    {
        if ($this->getUpdate() instanceof \App\Telegram\Model\Type\Update\MessageUpdate) {
            /**
             * @var \App\Telegram\Model\Type\Update\MessageUpdate $update
             */
            $update = $this->getUpdate();

            $updateChat = $update->getMessage()->getChat();

            $telegramChatEntity = $this->telegramChatRepository->find($updateChat->getId());
            if (is_null($telegramChatEntity)) {
                $telegramChatEntity = $this->telegramChatRepository->create(
                    $updateChat->getId(),
                    $updateChat->getType(),
                    $updateChat->getUsername(),
                    $updateChat->getFirstName(),
                    $updateChat->getLastName()
                );
            }

            //todo event user start register

            if ($this->sendFirstMessage($telegramChatEntity->getId())) {
                $this->userRepository->create($telegramChatEntity);
            }

            return;
        }

        /**
         * @var \App\Telegram\Model\Type\Update\CallbackQuery $callbackQuery
         */
        $callbackQuery = $this->getUpdate();
        $userEntity    = $this->userRepository->find($callbackQuery->getMessage()->getChat()->getId());

        $callbackData = $callbackQuery->getData();
        $callbackData = array_shift($callbackData);

        if ($callbackData == \App\Command\Register\StartStep::CALLBACK_STEP_NAME) {
            if ($this->editStartInlineKeyboards(
                $userEntity->getId(),
                $callbackQuery->getMessage()->getMessageId(),
                $callbackQuery->getMessage()->getText()
            )) {
                $userEntity->setRegisterSubjectStep();
                $this->userRepository->save($userEntity);

                $this->processAnotherCommand(\App\Command\ServiceResolver::REGISTER_SUBJECT_STEP_COMMAND_SERVICE);
            }
        }
    }

    // ########################################

    private function sendFirstMessage(int $chatId): bool
    {
        $sendMessageModel = $this->sendMessageFactory->create(
            $chatId,
            'Підготуватися до ЗНО дуже легко!) 10-15 хвилин щодня і ти отримаешь свої 200 балів!'//TODO TEXT
        );

        $replyMarkup = $this->inlineKeyboardMarkupFactory->create();
        $replyMarkup->addRowInlineKeyboard([
            $this->inlineKeyboardButtonFactory->create('Розпочати', json_encode([self::CALLBACK_STEP_NAME])),
        ]);
        $sendMessageModel->setReplyMarkup($replyMarkup);

        $response = $sendMessageModel->send();

        return $response !== false;
    }

    private function editStartInlineKeyboards(int $chatId, int $messageId, string $text)
    {
        $editMessageModel = $this->editMessageFactory->create($chatId, $messageId, $text);
        $response         = $editMessageModel->send();

        return $response !== false;
    }

    // ########################################
}
