<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Command\Process;

class SendMessage extends \App\Command\BaseAbstract
{
    /**
     * @var \App\Repository\Telegram\BotRepository
     */
    private $botRepository;

    // ########################################

    public function __construct(\App\Repository\Telegram\BotRepository $botRepository)
    {
        $this->botRepository = $botRepository;
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
        /** @var \App\Telegram\Model\Type\Update\MessageUpdate $messageUpdate */
        $messageUpdate = $this->getUpdate();

        // TODO: Implement processCommand() method.
    }

    // ########################################
}
