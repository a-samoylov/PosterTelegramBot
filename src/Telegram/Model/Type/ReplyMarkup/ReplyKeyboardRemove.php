<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\ReplyMarkup;

class ReplyKeyboardRemove extends BaseAbstract
{
    // ########################################

    /**
     * @var bool = true
     */
    protected $removeKeyboard = true;

    /**
     * @var bool
     */
    protected $selective;

    // ########################################

    /**
     * @return bool
     */
    public function isRemoveKeyboard(): bool
    {
        return $this->removeKeyboard;
    }

    // ########################################

    /**
     * @return bool
     */
    public function isSelective(): bool
    {
        return $this->selective;
    }

    /**
     * @param bool $selective
     */
    public function setSelective(bool $selective): void
    {
        $this->selective = $selective;
    }

    // ########################################
}
