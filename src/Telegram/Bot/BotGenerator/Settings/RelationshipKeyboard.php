<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Bot\BotGenerator\Settings;

class RelationshipKeyboard
{
    public const ACTION_OPEN_LAYOUT = 'open_layout';
    public const ACTION_EDIT_LAYOUT = 'edit_layout';

    // ########################################

    /**
     * @var int
     */
    private $layoutId;

    /**
     * @var string
     */
    private $buttonText;

    /**
     * @var array
     */
    private $action;

    // ########################################

    public function __construct(
        int $layoutId,
        string $buttonText,
        array $action
    ) {
        $this->layoutId   = $layoutId;
        $this->buttonText = $buttonText;
        $this->action     = $action;
    }

    // ########################################

    /**
     * @return int
     */
    public function getLayoutId(): int
    {
        return $this->layoutId;
    }

    public function getButtonText(): string
    {
        return $this->buttonText;
    }

    /**
     * @return array
     */
    public function getAction(): array
    {
        return $this->action;
    }

    // ########################################
}
