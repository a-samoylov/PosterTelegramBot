<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Bot\BotGenerator\Settings;

class Relationship
{
    public const ACTION_OPEN_LAYOUT = 'open_layout';
    public const ACTION_EDIT_LAYOUT = 'edit_layout';

    // ########################################

    /** @var \App\Entity\Telegram\Bot */
    private $bot;

    /**
     * @var int
     */
    private $layoutId;

    /**
     * @var int
     */
    private $buttonId;

    /**
     * @var string
     */
    private $action;

    /**
     * @var int
     */
    private $anotherId;

    // ########################################

    /**
     * @param \App\Entity\Telegram\Bot $bot
     * @param int                      $layoutId
     * @param int                      $buttonId
     * @param string                   $action
     * @param int                      $anotherId
     */
    public function __construct(
        \App\Entity\Telegram\Bot $bot,
        int $layoutId,
        int $buttonId,
        string $action,
        int $anotherId
    ) {
        $this->bot       = $bot;
        $this->layoutId  = $layoutId;
        $this->buttonId  = $buttonId;
        $this->action    = $action;
        $this->anotherId = $anotherId;
    }

    // ########################################

    /**
     * @return \App\Entity\Telegram\Bot
     */
    public function getBot(): \App\Entity\Telegram\Bot
    {
        return $this->bot;
    }

    /**
     * @return int
     */
    public function getLayoutId(): int
    {
        return $this->layoutId;
    }

    /**
     * @return int
     */
    public function getButtonId(): int
    {
        return $this->buttonId;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return int
     */
    public function getAnotherId(): int
    {
        return $this->anotherId;
    }

    // ########################################
}
