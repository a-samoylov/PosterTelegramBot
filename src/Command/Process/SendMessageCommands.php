<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Command\Process;

class SendMessageCommands extends \App\Command\BaseAbstract
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
    /**
     * @var \App\Telegram\Bot\Helper
     */
    private $helper;

    private $menuMessageRepository;

    private $commandProcessor;

    private $actionFactory;

    // ########################################

    public function __construct(
        \App\Repository\Telegram\UserRepository $userRepository,
        \App\Repository\Telegram\ChatRepository $telegramChatRepository,
        \App\Repository\Telegram\LayoutRepository $layoutRepository,
        \App\Telegram\Bot\Helper $helper,
        \App\Repository\Telegram\MenuMessageRepository $menuMessageRepository,
        \App\Command\ActionCommand\Processor $commandProcessor,
        \App\Command\ActionCommand\Action\Factory $actionFactory
    ) {
        $this->userRepository         = $userRepository;
        $this->telegramChatRepository = $telegramChatRepository;
        $this->layoutRepository       = $layoutRepository;
        $this->helper                 = $helper;
        $this->menuMessageRepository  = $menuMessageRepository;
        $this->commandProcessor       = $commandProcessor;
        $this->actionFactory          = $actionFactory;
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
            $chatEntity = $this->telegramChatRepository->create($updateChat->getId(), $updateChat->getType(), $updateChat->getUsername(),
                                                                $updateChat->getFirstName(), $updateChat->getLastName());
        }

        $userEntity = $this->userRepository->findByChat($chatEntity);
        if (is_null($userEntity)) {
            $userEntity = $this->userRepository->create($chatEntity);
        }

        $actions = [];

        $commands = $this->getBot()->getCommands();

        $text = $update->getMessage()->getText();

        if (isset($commands[$text])) {
            $actions[] = $commands[$text];
        } else {
            $sendMessage = $this->menuMessageRepository->findOneBy([
               'bot'        => $this->getBot()->getId(),
               'layout'     => $userEntity->getCurrentLayout(),
               'buttonText' => $text,
           ]);

            if (is_null($sendMessage)) {
                throw new \Exception("Action not found. Command: {$update->getMessage()->getText()}");
            }

            $actions = $sendMessage->getActions();
        }

        foreach ($actions as $actionData) {
            try {
                $this->commandProcessor->process($userEntity, $this->actionFactory->create($actionData));
            } catch (\Exception $exception) {
                // todo log
                break;
            }
        }
    }

    // ########################################
}
