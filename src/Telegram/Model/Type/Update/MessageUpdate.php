<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\Update;

class MessageUpdate extends BaseAbstract
{
    /**
     * Optional. New incoming message of any kind — text, photo, sticker, etc.
     *
     * @var \App\Telegram\Model\Type\Base\Message
     */
    protected $message;

    /**
     * MessageUpdate constructor.
     *
     * @param int                                           $updateId
     * @param \App\Telegram\Model\Type\Base\Message $message
     */
    public function __construct(int $updateId, \App\Telegram\Model\Type\Base\Message $message)
    {
        parent::__construct($updateId);
        $this->message = $message;
    }

    // ########################################

    /**
     * @return \App\Telegram\Model\Type\Base\Message
     */
    public function getMessage(): \App\Telegram\Model\Type\Base\Message
    {
        return $this->message;
    }

    // ########################################
}
