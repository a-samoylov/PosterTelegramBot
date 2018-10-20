<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Command;

class ServiceResolver
{
    public const DEFAULT_COMMAND_SERVICE      = 'telegram.command.default';
    public const SEND_MESSAGE_PROCESS_COMMAND = 'telegram.command.process.message';

    public const REGISTER_SUBJECT_STEP_COMMAND_SERVICE   = 'telegram.command.register.subjectstep';
    public const REGISTER_INTENSITY_STEP_COMMAND_SERVICE = 'telegram.command.register.intensitystep';

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
            $serviceName = $this->getServiceNameByCallbackQuery($update);
            if (!is_null($serviceName)) {
                return $serviceName;
            }
        }
        //todo other

        //todo event if cant found service name

        return self::DEFAULT_COMMAND_SERVICE;
    }

    // ########################################

    /**
     * @param \App\Telegram\Model\Type\Update\CallbackQuery $callbackQuery
     *
     * @return null|string
     * @throws \App\Model\Exception\Logic
     */
    private function getServiceNameByCallbackQuery(\App\Telegram\Model\Type\Update\CallbackQuery $callbackQuery): ?string
    {
        $userEntity = $this->userRepository->find($callbackQuery->getFrom()->getId());
        if (is_null($userEntity)) {
            throw new \App\Model\Exception\Logic('Not found user by chat id from callback query.');
        }

        return null;
    }

    // ########################################
}
