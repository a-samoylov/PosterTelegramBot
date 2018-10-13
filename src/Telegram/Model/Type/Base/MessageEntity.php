<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\Base;

class MessageEntity
{
    private const TYPE_MENTION = 'mentin';
    private const TYPE_HASHTAG = 'hashtag';
    private const TYPE_BOT_COMMAND = 'bot_command';
    private const TYPE_URL = 'url';
    private const TYPE_EMAIL = 'email';
    private const TYPE_BOLD = 'bold';
    private const TYPE_ITALIC = 'italic';
    private const TYPE_CODE = 'code';
    private const TYPE_PRE = 'pre';
    private const TYPE_TEXT_LINK = 'text_link';

    // ########################################

    /**
     * Type of the entity.
     * One of mention (@username), hashtag, bot_command, url, email, bold (bold text),
     * italic (italic text), code (monowidth string),pre (monowidth block), text_link (for clickable text URLs)
     *
     * @var string
     */
    protected $type;

    /**
     * Offset in UTF-16 code units to the start of the entity
     *
     * @var int
     */
    protected $offset;

    /**
     * Length of the entity in UTF-16 code units
     *
     * @var int
     */
    protected $length;

    /**
     * Optional. For “text_link” only, url that will be opened after user taps on the text
     *
     * @var string
     */
    protected $url;

    /**
     * Optional. Optional. For “text_mention” only, the mentioned user
     *
     * @var \App\Telegram\Model\Type\Base\User
     */
    protected $user;


    // ########################################

    /**
     * MessageEntity constructor.
     *
     * @param string $type
     * @param int    $offset
     * @param int    $length
     */
    public function __construct(
        string $type,
        int $offset,
        int $length
    ) {
        $this->type   = $type;
        $this->offset = $offset;
        $this->length = $length;
    }

    // ########################################

    /**
     * @return string
     */
    public function getType(): string
    {
        //todo make isType...
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @param int $offset
     */
    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param int $length
     */
    public function setLength(int $length): void
    {
        $this->length = $length;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\User
     */
    public function getUser(): \App\Telegram\Model\Type\Base\User
    {
        return $this->user;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\User $user
     */
    public function setUser(\App\Telegram\Model\Type\Base\User $user): void
    {
        $this->user = $user;
    }

    // ########################################
}
