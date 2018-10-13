<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\Update;

abstract class BaseAbstract
{
    // ########################################

    /**
     * The update‘s unique identifier.
     * Update identifiers start from a certain positive number and increase sequentially.
     * This ID becomes especially handy if you’re using Webhooks, since it allows you to ignore repeated updates or
     * to restore the correct update sequence, should they get out of order.
     *
     * @var integer
     */
    protected $updateId;

    // ########################################

    /**
     * BaseAbstract constructor.
     *
     * @param int $updateId
     */
    public function __construct(int $updateId)
    {
        $this->updateId = $updateId;
    }

    // ########################################

    /**
     * @return int
     */
    public function getUpdateId(): int
    {
        return $this->updateId;
    }

    // ########################################

    public function isCallbackQuery(): bool
    {
        return $this instanceof CallbackQuery;
    }

    public function isMessageUpdate(): bool
    {
        return $this instanceof MessageUpdate;
    }

    // ########################################
}
