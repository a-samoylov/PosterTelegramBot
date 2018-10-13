<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Command\Register;

class SubjectStep extends \App\Command\BaseAbstract
{
    private const BUTTON_SAVE_TEXT = 'Зберегти';

    private const COUNT_SUBJECTS_IN_ROW = 2;

    /**
     * @var \App\Telegram\Model\Methods\Send\Message\Factory
     */
    private $sendMessageFactory;

    /**
     * @var \App\Telegram\Model\Methods\Edit\Message\Factory
     */
    private $editMessageFactory;

    /**
     * @var \App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardMarkup\Factory
     */
    private $replyKeyboardMarkupFactory;

    /**
     * @var \App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardMarkup\KeyboardButton\Factory
     */
    private $keyboardButtonFactory;

    /**
     * @var \App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardRemove
     */
    private $replyKeyboardRemove;

    /**
     * @var \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\Factory
     */
    private $inlineKeyboardMarkupFactory;

    /**
     * @var \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\InlineKeyboardButton\Factory
     */
    private $inlineKeyboardButtonFactory;

    /**
     * @var \App\Repository\UserRepository
     */
    private $userRepository;

    /**
     * @var \App\Repository\SubjectRepository
     */
    private $subjectRepository;

    /**
     * @var \App\Model\Helper\Emoji
     */
    private $emojiHelper;

    // ########################################

    public function __construct(
        \App\Telegram\Model\Methods\Send\Message\Factory                                       $sendMessageFactory,
        \App\Telegram\Model\Methods\Edit\Message\Factory                                       $editMessageFactory,
        \App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardMarkup\Factory                       $replyKeyboardMarkupFactory,
        \App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardMarkup\KeyboardButton\Factory        $keyboardButtonFactory,
        \App\Telegram\Model\Type\ReplyMarkup\ReplyKeyboardRemove                               $replyKeyboardRemove,
        \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\Factory                      $inlineKeyboardMarkupFactory,
        \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup\InlineKeyboardButton\Factory $inlineKeyboardButtonFactory,
        \App\Repository\UserRepository                                                         $userRepository,
        \App\Repository\SubjectRepository                                                      $subjectRepository,
        \App\Model\Helper\Emoji                                                                $emojiHelper
    ) {
        $this->sendMessageFactory          = $sendMessageFactory;
        $this->editMessageFactory          = $editMessageFactory;
        $this->replyKeyboardMarkupFactory  = $replyKeyboardMarkupFactory;
        $this->keyboardButtonFactory       = $keyboardButtonFactory;
        $this->replyKeyboardRemove         = $replyKeyboardRemove;
        $this->inlineKeyboardMarkupFactory = $inlineKeyboardMarkupFactory;
        $this->inlineKeyboardButtonFactory = $inlineKeyboardButtonFactory;
        $this->userRepository              = $userRepository;
        $this->subjectRepository           = $subjectRepository;
        $this->emojiHelper                 = $emojiHelper;
    }

    // ########################################
    /**
     * @return bool|string
     */
    public function validate()
    {
        if (!$this->getUpdate()->isCallbackQuery() && !$this->getUpdate()->isMessageUpdate()) {
            return 'Wrong update type.';
        }

        if ($this->getUpdate() instanceof \App\Telegram\Model\Type\Update\CallbackQuery) {
            /**
             * @var \App\Telegram\Model\Type\Update\CallbackQuery $callbackQuery
             */
            $callbackQuery = $this->getUpdate();
            if (!$callbackQuery->hasData()) {
                return 'Callback data is empty.';
            }

            $userEntity = $this->userRepository->find($callbackQuery->getMessage()->getChat()->getId());
            if (is_null($userEntity)) {
                return 'User in not found.';
            }

            return true;
        }

        /**
         * @var \App\Telegram\Model\Type\Update\MessageUpdate $messageUpdate
         */
        $messageUpdate = $this->getUpdate();
        $userEntity    = $this->userRepository->find($messageUpdate->getMessage()->getChat()->getId());
        if (is_null($userEntity)) {
            return 'User in not found.';
        }

        return true;
    }

    // ########################################

    public function processCommand(): void
    {
        if ($this->getUpdate() instanceof \App\Telegram\Model\Type\Update\CallbackQuery) {
            /**
             * @var \App\Telegram\Model\Type\Update\CallbackQuery $callbackQuery
             */
            $callbackQuery = $this->getUpdate();
            $userEntity    = $this->userRepository->find($callbackQuery->getMessage()->getChat()->getId());

            $callbackData = $callbackQuery->getData();
            $callbackData = array_shift($callbackData);

            if ($callbackData == \App\Command\Register\StartStep::CALLBACK_STEP_NAME) {
                if ($this->sendSubjects($userEntity, 'Оберіть предмети для заннятя')) {//TODO TEXT
                    $userEntity->setRegisterSubjectStep();
                    $this->userRepository->save($userEntity);
                }
            }

            return;
        }

        /**
         * @var \App\Telegram\Model\Type\Update\MessageUpdate $messageUpdate
         */
        $messageUpdate = $this->getUpdate();
        $userEntity    = $this->userRepository->find($messageUpdate->getMessage()->getChat()->getId());

        if ($messageUpdate->getMessage()->getText() == self::BUTTON_SAVE_TEXT) {
            if (!$userEntity->hasSubjects()) {
                $sendMessageModel = $this->sendMessageFactory->create($userEntity->getChat()->getId(), 'Оберіть хоча б один предмет');//TODO TEXT
                $sendMessageModel->send();
            }

            if ($this->sendSaveSubject($userEntity)) {
                $userEntity->setRegisterIntensityStep();
                $this->userRepository->save($userEntity);

                $this->processAnotherCommand(\App\Command\ServiceResolver::REGISTER_INTENSITY_STEP_COMMAND_SERVICE);
            }

            return;
        }

        $incomingText = $messageUpdate->getMessage()->getText();
        $subjects     = $this->subjectRepository->findAll();
        foreach ($subjects as $subject) {
            if ($subject->getName()      == $incomingText ||
                $subject->getShortName() == $incomingText ||
                $subject->getName()      == substr($incomingText, 1) ||
                $subject->getShortName() == substr($incomingText, 1)
            ) {
                if ($userEntity->hasSubject($subject)) {
                    $userEntity->removeSubject($subject);
                    $this->userRepository->save($userEntity);

                    $this->sendSubjects($userEntity, "Предмет: \"{$subject->getName()}\" прибранно.");//TODO TEXT

                    return;
                }

                $userEntity->addSubject($subject);
                $this->userRepository->save($userEntity);

                $this->sendSubjects($userEntity, "Предмет: \"{$subject->getName()}\" доданно.");//TODO TEXT

                return;
            }
        }
    }

    // ########################################

    private function sendSubjects(\App\Entity\User $user, string $text)
    {
        $sendMessageModel = $this->sendMessageFactory->create($user->getChat()->getId(), $text);

        $subjects = $this->subjectRepository->findAll();

        $replyKeyboardMarkup = $this->replyKeyboardMarkupFactory->create();

        $row = [];
        foreach ($subjects as $subject) {
            $subjectName = $subject->isHasShortName() ? $subject->getShortName() : $subject->getName();
            $subjectName = $user->hasSubject($subject) ? $this->emojiHelper->getGreenCheck() . $subjectName : $subjectName;

            $row[] = $this->keyboardButtonFactory->create($subjectName);
            if (count($row) == self::COUNT_SUBJECTS_IN_ROW) {
                $replyKeyboardMarkup->addKeyboardButtonRow($row);
                $row = [];
            }
        }

        if (!empty($row)) {
            $replyKeyboardMarkup->addKeyboardButtonRow($row);
        }

        $replyKeyboardMarkup->addKeyboardButtonRow([$this->keyboardButtonFactory->create(self::BUTTON_SAVE_TEXT)]);
        $replyKeyboardMarkup->setResizeKeyboard(true);

        $sendMessageModel->setReplyMarkup($replyKeyboardMarkup);

        $response = $sendMessageModel->send();

        return $response !== false;
    }

    // ########################################

    private function sendSaveSubject(\App\Entity\User $user)
    {
        $sendMessageModel = $this->sendMessageFactory->create($user->getChat()->getId(), 'Вітаємо предмети обранно!');//TODO TEXT
        $sendMessageModel->setReplyMarkup($this->replyKeyboardRemove);

        $response = $sendMessageModel->send();

        return $response !== false;
    }

    // ########################################
}
