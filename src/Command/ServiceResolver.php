<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Command;

class ServiceResolver
{
    public const DEFAULT_COMMAND_SERVICE          = 'telegram.command.default';
    public const SEND_MESSAGE_PROCESS_COMMAND     = 'telegram.command.process.send.message';
    public const CALLBACK_MESSAGE_PROCESS_COMMAND = 'telegram.command.process.callback.message';

    /**
     * @var \App\Repository\UserRepository
     */
    private $userRepository;

    // ########################################

    public function __construct(\App\Repository\UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    // ########################################
    /**
     * @param \App\Telegram\Model\Type\Update\BaseAbstract $update
     *
     * @return string
     */
    public function resolve($update): string
    {
        if ($update instanceof \App\Telegram\Model\Type\Update\MessageUpdate) {
            return self::SEND_MESSAGE_PROCESS_COMMAND;
        }

        if ($update instanceof \App\Telegram\Model\Type\Update\CallbackQuery) {
            return self::CALLBACK_MESSAGE_PROCESS_COMMAND;
        }
        //todo other

        //todo event if cant found service name

        return self::DEFAULT_COMMAND_SERVICE;
    }

    // ########################################
}
