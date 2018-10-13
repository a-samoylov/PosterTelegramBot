<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\Update\CallbackQuery;

class CallbackData
{
    /**
     * @var int
     */
    private $callbackId;

    /**
     * @var int
     */
    private $buttonId;

    // ########################################

    /**
     * CallbackData constructor.
     *
     * @param int $callbackId
     * @param int $buttonId
     */
    public function __construct(int $callbackId, int $buttonId)
    {
        $this->callbackId = $callbackId;
        $this->buttonId   = $buttonId;
    }

    // ########################################

    /**
     * @return int
     */
    public function getCallbackId(): int
    {
        return $this->callbackId;
    }

    /**
     * @return int
     */
    public function getButtonId(): int
    {
        return $this->buttonId;
    }

    // ########################################
}
