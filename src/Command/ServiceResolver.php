<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Command;

class ServiceResolver
{
    public const DEFAULT_COMMAND_SERVICE                 = 'telegram.default.command';
    public const REGISTER_START_STEP_COMMAND_SERVICE     = 'telegram.command.register.startstep';
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
            $serviceName = $this->getServiceNameByMessageUpdate($update);
            if (!is_null($serviceName)) {
                return $serviceName;
            }
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
     * @param \App\Telegram\Model\Type\Update\MessageUpdate $update
     *
     * @return null|string
     */
    private function getServiceNameByMessageUpdate(\App\Telegram\Model\Type\Update\MessageUpdate $update): ?string
    {
        $userEntity = $this->userRepository->find($update->getMessage()->getChat()->getId());
        if (is_null($userEntity)) {
            return self::REGISTER_START_STEP_COMMAND_SERVICE;
        }

        if ($userEntity->isRegisterSubjectStep()) {
            return self::REGISTER_SUBJECT_STEP_COMMAND_SERVICE;
        }

        return null;
    }

    // ----------------------------------------

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

        if ($userEntity->isRegister()) {
            //todo ZNO test
        }

        if ($userEntity->isRegisterStartStep()) {
            return self::REGISTER_START_STEP_COMMAND_SERVICE;
        }

        if ($userEntity->isRegisterSubjectStep()) {
            return self::REGISTER_SUBJECT_STEP_COMMAND_SERVICE;
        }

        if ($userEntity->isRegisterSubjectStep()) {
            return self::REGISTER_INTENSITY_STEP_COMMAND_SERVICE;
        }

        return null;
    }

    // ########################################
}
