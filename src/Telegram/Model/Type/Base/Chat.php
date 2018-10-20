<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\Base;

class Chat
{
    // ########################################

    /**
     * Unique identifier for this chat, not exceeding 1e13 by absolute value
     *
     * @var int
     */
    protected $id;

    /**
     * Type of chat, can be either “private”, “group”, “supergroup” or “channel”
     *
     * @var string
     */
    protected $type;

    /**
     * Optional. Title, for channels and group chats
     *
     * @var string
     */
    protected $title;

    /**
     * Optional. Username, for private chats and channels if available
     *
     * @var string
     */
    protected $username;

    /**
     * Optional. First name of the other party in a private chat
     *
     * @var string
     */
    protected $firstName;

    /**
     * Optional. Last name of the other party in a private chat
     *
     * @var string
     */
    protected $lastName;

    /**
     * Optional. True if a group has ‘All Members Are Admins’ enabled.
     *
     * @var bool
     */
    protected $allMembersAreAdministrators;

    /**
     * Optional. Chat photo. Returned only in getChat.
     *
     * @var ChatPhoto
     */
    protected $photo;

    /**
     * Optional. Description, for supergroups and channel chats. Returned only in getChat.
     *
     * @var string
     */
    protected $description;

    /**
     * Optional. Chat invite link, for supergroups and channel chats. Returned only in getChat.
     *
     * @var string
     */
    protected $inviteLink;

    /**
     * Optional. Pinned message, for supergroups. Returned only in getChat.
     *
     * @var Message
     */
    protected $pinnedMessage;

    /**
     * Optional. For supergroups, name of group sticker set. Returned only in getChat.
     *
     * @var string
     */
    protected $stickerSetName;

    /**
     * Optional. True, if the bot can change the group sticker set. Returned only in getChat.
     *
     * @var bool
     */
    protected $canSetStickerSet;

    // ########################################

    public function __construct(
        int $id,
        string $type
    ) {
        $this->id   = $id;
        $this->type = $type;
    }

    // ########################################

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
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
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return bool
     */
    public function isAllMembersAreAdministrators(): bool
    {
        return $this->allMembersAreAdministrators;
    }

    /**
     * @param bool $allMembersAreAdministrators
     */
    public function setAllMembersAreAdministrators(bool $allMembersAreAdministrators): void
    {
        $this->allMembersAreAdministrators = $allMembersAreAdministrators;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\ChatPhoto
     */
    public function getPhoto(): \App\Telegram\Model\Type\Base\ChatPhoto
    {
        return $this->photo;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\ChatPhoto $photo
     */
    public function setPhoto(\App\Telegram\Model\Type\Base\ChatPhoto $photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getInviteLink(): string
    {
        return $this->inviteLink;
    }

    /**
     * @param string $inviteLink
     */
    public function setInviteLink(string $inviteLink): void
    {
        $this->inviteLink = $inviteLink;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\Message
     */
    public function getPinnedMessage(): \App\Telegram\Model\Type\Base\Message
    {
        return $this->pinnedMessage;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\Message $pinnedMessage
     */
    public function setPinnedMessage(\App\Telegram\Model\Type\Base\Message $pinnedMessage): void
    {
        $this->pinnedMessage = $pinnedMessage;
    }

    /**
     * @return string
     */
    public function getStickerSetName(): string
    {
        return $this->stickerSetName;
    }

    /**
     * @param string $stickerSetName
     */
    public function setStickerSetName(string $stickerSetName): void
    {
        $this->stickerSetName = $stickerSetName;
    }

    /**
     * @return bool
     */
    public function isCanSetStickerSet(): bool
    {
        return $this->canSetStickerSet;
    }

    /**
     * @param bool $canSetStickerSet
     */
    public function setCanSetStickerSet(bool $canSetStickerSet): void
    {
        $this->canSetStickerSet = $canSetStickerSet;
    }

    // ########################################
}
