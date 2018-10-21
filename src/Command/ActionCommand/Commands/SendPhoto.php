<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Command\ActionCommand\Commands;

class SendPhoto extends \App\Command\ActionCommand\BaseAbstract
{
    /**
     * @var \App\Repository\Telegram\LayoutRepository
     */
    private $layoutRepository;

    private $userRepository;

    /**
     * @var \App\Telegram\Model\Methods\Send\Photo
     */
    private $sendPhotoFactory;

    // ########################################

    public function __construct(
        \App\Repository\Telegram\LayoutRepository $layoutRepository,
        \App\Repository\Telegram\UserRepository $userRepository,
        \App\Telegram\Model\Methods\Send\Photo\Factory $sendPhotoFactory
    ) {
        $this->layoutRepository = $layoutRepository;
        $this->userRepository   = $userRepository;
        $this->sendPhotoFactory = $sendPhotoFactory;
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
        if (!isset($params['url'])) {
            return 'Invalid url';
        }

        return true;
    }

    // ########################################

    public function processCommand(
        \App\Telegram\Model\Type\Update\BaseAbstract $update,
        \App\Entity\Telegram\User $user,
        array $params
    ): void {
        $sendPhotoModel = $this->sendPhotoFactory->create($user->getChat()->getId(), $user->getTelegramBot(), '', $params['url']);

        $message = $sendPhotoModel->send();

        $user->setLastMessageId((int)$message['message_id']);
        $this->userRepository->save($user);
    }

    // ########################################
}
