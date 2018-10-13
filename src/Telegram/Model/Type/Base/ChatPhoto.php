<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\Base;

class ChatPhoto
{
    // ########################################

    /**
     * Unique file identifier of small (160x160) chat photo. This file_id can be used only for photo download.
     *
     * @var string
     */
    protected $smallFileId;

    /**
     * Unique file identifier of big (640x640) chat photo. This file_id can be used only for photo download.
     *
     * @var string
     */
    protected $bigFileId;

    /**
     * ChatPhoto constructor.
     *
     * @param string $smallFileId
     * @param string $bigFileId
     */
    public function __construct(string $smallFileId, string $bigFileId)
    {
        $this->smallFileId = $smallFileId;
        $this->bigFileId   = $bigFileId;
    }

    // ########################################

    /**
     * @return string
     */
    public function getSmallFileId(): string
    {
        return $this->smallFileId;
    }

    /**
     * @return string
     */
    public function getBigFileId(): string
    {
        return $this->bigFileId;
    }

    // ########################################
}
