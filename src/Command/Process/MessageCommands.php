<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Command\Process;

class MessageCommands extends \App\Command\BaseAbstract
{
    /**
     * @var \App\Repository\UserRepository
     */
    private $userRepository;

    /**
     * @var \App\Repository\Telegram\ChatRepository
     */
    private $telegramChatRepository;

    /**
     * @var \App\Repository\Telegram\LayoutRepository
     */
    private $layoutRepository;

    // ########################################

    public function __construct(
        \App\Repository\UserRepository            $userRepository,
        \App\Repository\Telegram\ChatRepository   $telegramChatRepository,
        \App\Repository\Telegram\LayoutRepository $layoutRepository
    ) {
        $this->userRepository         = $userRepository;
        $this->telegramChatRepository = $telegramChatRepository;
        $this->layoutRepository       = $layoutRepository;
    }

    // ########################################

    /**
     * @return string|bool
     */
    public function validate()
    {
        if (!$this->getUpdate()->isMessageUpdate()) {
            return 'Wrong update type.';
        }

        return true;
    }

    public function processCommand(): void
    {
        /** @var \App\Telegram\Model\Type\Update\MessageUpdate $update */
        $update = $this->getUpdate();

        $updateChat = $update->getMessage()->getChat();

        $chatEntity = $this->telegramChatRepository->find($updateChat->getId());
        if (is_null($chatEntity)) {
            $chatEntity = $this->telegramChatRepository->create(
                $updateChat->getId(),
                $updateChat->getType(),
                $updateChat->getUsername(),
                $updateChat->getFirstName(),
                $updateChat->getLastName()
            );
        }

        $userEntity = $this->userRepository->findByChatId($chatEntity);
        if (is_null($userEntity)) {
            $userEntity = $this->userRepository->create($chatEntity);
        }

        $commands = $this->getBot()->getCommands();
        if (!isset($commands[$update->getMessage()->getText()])) {
            return;
        }

        $layoutId = $commands[$update->getMessage()->getText()];
        $layout   = $this->layoutRepository->find(['layoutId' => $layoutId]);
        if (is_null($layout)) {
            throw new \Exception("Command layout not found. Command: {$update->getMessage()->getText()}");
        }


    }

    // ########################################
}
