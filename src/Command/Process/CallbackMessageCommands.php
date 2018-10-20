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

    // ########################################

    public function __construct(
        \App\Repository\Telegram\UserRepository            $userRepository,
        \App\Repository\Telegram\CallbackMessageRepository $callbackMessageRepository,
        \App\Telegram\Bot\Helper                           $helper
    ) {
        $this->userRepository            = $userRepository;
        $this->helper                    = $helper;
        $this->callbackMessageRepository = $callbackMessageRepository;
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
        if (!isset($data['bot']) || !isset($data['btn'])) {
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
        $botId    = $data['bot'];
        $buttonId = $data['btn'];

        $callbackMessage = $this->callbackMessageRepository->findOneBy([
            'bot'      => $botId,
            'buttonId' => $buttonId,
        ]);

        if (is_null($callbackMessage)) {
            return;
        }

        //$callbackMessage->getAction();
        //todo check action

        $this->helper->sendLayout($userEntity, $callbackMessage->getLayout());
    }

    // ########################################
}
