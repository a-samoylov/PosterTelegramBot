<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Command\Process;

class CallbackMessageCommands extends \App\Command\BaseAbstract
{
    /**
     * @var \App\Command\ActionCommand\Processor
     */
    private $actionCommandProcessor;

    /**
     * @var \App\Repository\UserRepository
     */
    private $userRepository;

    /**
     * @var \App\Telegram\Bot\Helper
     */
    private $helper;

    /**
     * @var \App\Repository\Telegram\CallbackMessageRepository
     */
    private $callbackMessageRepository;
    /**
     * @var \App\Command\ActionCommand\Action\Factory
     */
    private $actionFactory;

    // ########################################

    public function __construct(
        \App\Command\ActionCommand\Processor               $actionCommandProcessor,
        \App\Repository\Telegram\UserRepository            $userRepository,
        \App\Repository\Telegram\CallbackMessageRepository $callbackMessageRepository,
        \App\Telegram\Bot\Helper                           $helper,
        \App\Command\ActionCommand\Action\Factory          $actionFactory
    ) {
        $this->userRepository            = $userRepository;
        $this->helper                    = $helper;
        $this->callbackMessageRepository = $callbackMessageRepository;
        $this->actionFactory             = $actionFactory;
        $this->actionCommandProcessor    = $actionCommandProcessor;
    }

    // ########################################

    /**
     * @return string|bool
     */
    public function validate()
    {
        if (!$this->getUpdate()->isCallbackQuery()) {
            return 'Wrong update type.';
        }

        /** @var \App\Telegram\Model\Type\Update\CallbackQuery $update */
        $update = $this->getUpdate();

        $data = $update->getData();
        if (!isset($data['lt']) || !isset($data['btn'])) {
            return 'Wrong callback data';
        }

        return true;
    }

    public function processCommand(): void
    {
        /** @var \App\Telegram\Model\Type\Update\CallbackQuery $update */
        $update = $this->getUpdate();

        $userEntity = $this->userRepository->findOneBy(['chat' => $update->getMessage()->getChat()->getId()]);
        if (is_null($userEntity)) {
            throw new \Exception('User not found.');
        }

        $data     = $update->getData();
        $botId    = $this->getBot()->getId();
        $layoutId = $data['lt'];
        $buttonId = $data['btn'];

        $callbackMessage = $this->callbackMessageRepository->findOneBy([
            'bot'      => $botId,
            'layout'   => $layoutId,
            'buttonId' => $buttonId,
        ]);

        if (is_null($callbackMessage)) {
            return;
        }

        foreach ($callbackMessage->getActions() as $actionData) {
            try {
                $this->actionCommandProcessor->process($this->actionFactory->create($actionData));
            } catch (\Exception $exception) {
                // todo log
                break;
            }
        }

        //$this->helper->sendLayout($userEntity, $callbackMessage->getLayout());
    }

    // ########################################
}
