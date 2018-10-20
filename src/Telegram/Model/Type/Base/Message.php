<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\Base;

class Message
{
    /**
     * Unique message identifier
     *
     * @var int
     */
    protected $messageId;

    /**
     * Optional. Sender name. Can be empty for messages sent to channels
     *
     * @var User
     */
    protected $from;

    /**
     * Date the message was sent in Unix time
     *
     * @var \DateTime
     */
    protected $date;

    /**
     * Conversation the message belongs to — user in case of a private message, GroupChat in case of a group
     *
     * @var Chat
     */
    protected $chat;

    /**
     * Optional. For forwarded messages, sender of the original message
     *
     * @var User
     */
    protected $forwardFrom;

    /**
     * Optional. For messages forwarded from channels, information about the original channel
     *
     * @var Chat
     */
    protected $forwardFromChat;

    /**
     * Optional. For messages forwarded from channels, identifier of the original message in the channel
     *
     * @var int
     */
    protected $forwardFromMessageId;


    /**
     * Optional. For messages forwarded from channels, signature of the post author if present
     *
     * @var string
     */
    protected $forwardSignature;

    /**
     * Optional. For forwarded messages, date the original message was sent in Unix time
     *
     * @var \DateTime
     */
    protected $forwardDate;

    /**
     * Optional. For replies, the original message. Note that the Message object in this field will not contain further
     * reply_to_message fields even if it itself is a reply.
     *
     * @var Message
     */
    protected $replyToMessage;

    /**
     * Optional. Date the message was last edited in Unix time
     *
     * @var \DateTime
     */
    protected $editDate;

    /**
     * Optional. The unique identifier of a media message group this message belongs to
     *
     * @var int
     */
    protected $mediaGroupId;

    /**
     * Optional. Signature of the post author for messages in channels
     *
     * @var string
     */
    protected $authorSignature;

    /**
     * Optional. For text messages, the actual UTF-8 text of the message
     *
     * @var string
     */
    protected $text;

    /**
     * Optional. For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text.
     * array of \TelegramBot\Api\Types\MessageEntity
     *
     * @var MessageEntity[]
     */
    protected $entities;

    /**
     * Optional. For messages with a caption, special entities like usernames, URLs, bot commands, etc. that appear in the caption
     *
     * @var MessageEntity[]
     */
    protected $captionEntities;

    /**
     * Optional. Message is an audio file, information about the file
     *
     * @var Audio
     */
    protected $audio;

    /**
     * Optional. Message is a general file, information about the file
     *
     * @var Document
     */
    protected $document;

    /**
     * Optional. Message is an animation, information about the animation.
     * For backward compatibility, when this field is set, the document field will also be set
     *
     * @var Animation
     */
    protected $animation;

    /**
     * Optional. Message is a game, information about the game.
     *
     * @var Game
     */
    protected $game;

    /**
     * Optional. Message is a photo, available sizes of the photo
     *
     * @var PhotoSize[]
     */
    protected $photo;

    /**
     * Optional. Message is a sticker, information about the sticker
     *
     * @var Sticker
     */
    protected $sticker;

    /**
     * Optional. Message is a video, information about the video
     *
     * @var Video
     */
    protected $video;

    /**
     * Optional. Message is a voice message, information about the file
     *
     * @var Voice
     */
    protected $voice;

    /**
     * Optional. Message is a video note, information about the video message
     *
     * @var VoiceNote
     */
    protected $voiceNote;

    /**
     * Optional. Caption for the audio, document, photo, video or voice, 0-200 characters
     *
     * @var string
     */
    protected $caption;

    /**
     * Optional. Message is a shared contact, information about the contact
     *
     * @var Contact
     */
    protected $contact;

    /**
     * Optional. Message is a shared location, information about the location
     *
     * @var Location
     */
    protected $location;

    /**
     * Optional. Message is a venue, information about the venue
     *
     * @var Venue
     */
    protected $venue;

    /**
     * Optional. A new member was added to the group, information about them (this member may be bot itself)
     *
     * @var User
     */
    protected $newChatMember;

    /**
     * Optional. A member was removed from the group, information about them (this member may be bot itself)
     *
     * @var User
     */
    protected $leftChatMember;

    /**
     * Optional. A group title was changed to this value
     *
     * @var string
     */
    protected $newChatTitle;

    /**
     * Optional. A group photo was change to this value
     *
     * @var PhotoSize[]
     */
    protected $newChatPhoto;

    /**
     * Optional. Informs that the group photo was deleted
     *
     * @var bool
     */
    protected $deleteChatPhoto;

    /**
     * Optional. Informs that the group has been created
     *
     * @var bool
     */
    protected $groupChatCreated;

    /**
     * Optional. Service message: the supergroup has been created
     *
     * @var bool
     */
    protected $superGroupChatCreated;

    /**
     * Optional. Service message: the channel has been created
     *
     * @var bool
     */
    protected $channelChatCreated;

    /**
     * Optional. The group has been migrated to a supergroup with the specified identifier,
     * not exceeding 1e13 by absolute value
     *
     * @var int
     */
    protected $migrateToChatId;

    /**
     * Optional. The supergroup has been migrated from a group with the specified identifier,
     * not exceeding 1e13 by absolute value
     *
     * @var int
     */
    protected $migrateFromChatId;

    /**
     * Optional. Specified message was pinned.Note that the Message object in this field
     * will not contain further reply_to_message fields even if it is itself a reply.
     *
     * @var Message
     */
    protected $pinnedMessage;

    /**
     * Optional. Message is an invoice for a payment, information about the invoice.
     *
     * @var Invoice
     */
    protected $invoice;

    /**
     * Optional. Message is a service message about a successful payment, information about the payment.
     *
     * @var SuccessfulPayment
     */
    protected $successfulPayment;

    /**
     * Optional. The domain name of the website on which the user has logged in.
     *
     * @var string
     */
    protected $connectedWebsite;

    /**
     * Optional. Telegram Passport data
     *
     * @var PassportData
     */
    protected $passportData;

    // ########################################

    /**
     * Message constructor.
     *
     * @param int                                   $messageId
     * @param \DateTime                             $date
     * @param \App\Telegram\Model\Type\Base\Chat $chat
     */
    public function __construct(
        int $messageId,
        \DateTime $date,
        \App\Telegram\Model\Type\Base\Chat $chat
    ) {
        $this->messageId = $messageId;
        $this->date      = $date;
        $this->chat      = $chat;
    }

    // ########################################

    /**
     * @return int
     */
    public function getMessageId(): int
    {
        return $this->messageId;
    }

    /**
     * @param int $messageId
     */
    public function setMessageId(int $messageId): void
    {
        $this->messageId = $messageId;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\User
     */
    public function getFrom(): \App\Telegram\Model\Type\Base\User
    {
        return $this->from;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\User $from
     */
    public function setFrom(\App\Telegram\Model\Type\Base\User $from): void
    {
        $this->from = $from;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\Chat
     */
    public function getChat(): \App\Telegram\Model\Type\Base\Chat
    {
        return $this->chat;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\Chat $chat
     */
    public function setChat(\App\Telegram\Model\Type\Base\Chat $chat): void
    {
        $this->chat = $chat;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\User
     */
    public function getForwardFrom(): \App\Telegram\Model\Type\Base\User
    {
        return $this->forwardFrom;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\User $forwardFrom
     */
    public function setForwardFrom(\App\Telegram\Model\Type\Base\User $forwardFrom): void
    {
        $this->forwardFrom = $forwardFrom;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\Chat
     */
    public function getForwardFromChat(): \App\Telegram\Model\Type\Base\Chat
    {
        return $this->forwardFromChat;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\Chat $forwardFromChat
     */
    public function setForwardFromChat(\App\Telegram\Model\Type\Base\Chat $forwardFromChat): void
    {
        $this->forwardFromChat = $forwardFromChat;
    }

    /**
     * @return int
     */
    public function getForwardFromMessageId(): int
    {
        return $this->forwardFromMessageId;
    }

    /**
     * @param int $forwardFromMessageId
     */
    public function setForwardFromMessageId(int $forwardFromMessageId): void
    {
        $this->forwardFromMessageId = $forwardFromMessageId;
    }

    /**
     * @return string
     */
    public function getForwardSignature(): string
    {
        return $this->forwardSignature;
    }

    /**
     * @param string $forwardSignature
     */
    public function setForwardSignature(string $forwardSignature): void
    {
        $this->forwardSignature = $forwardSignature;
    }

    /**
     * @return \DateTime
     */
    public function getForwardDate(): \DateTime
    {
        return $this->forwardDate;
    }

    /**
     * @param \DateTime $forwardDate
     */
    public function setForwardDate(\DateTime $forwardDate): void
    {
        $this->forwardDate = $forwardDate;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\Message
     */
    public function getReplyToMessage(): \App\Telegram\Model\Type\Base\Message
    {
        return $this->replyToMessage;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\Message $replyToMessage
     */
    public function setReplyToMessage(\App\Telegram\Model\Type\Base\Message $replyToMessage): void
    {
        $this->replyToMessage = $replyToMessage;
    }

    /**
     * @return \DateTime
     */
    public function getEditDate(): \DateTime
    {
        return $this->editDate;
    }

    /**
     * @param \DateTime $editDate
     */
    public function setEditDate(\DateTime $editDate): void
    {
        $this->editDate = $editDate;
    }

    /**
     * @return int
     */
    public function getMediaGroupId(): int
    {
        return $this->mediaGroupId;
    }

    /**
     * @param int $mediaGroupId
     */
    public function setMediaGroupId(int $mediaGroupId): void
    {
        $this->mediaGroupId = $mediaGroupId;
    }

    /**
     * @return string
     */
    public function getAuthorSignature(): string
    {
        return $this->authorSignature;
    }

    /**
     * @param string $authorSignature
     */
    public function setAuthorSignature(string $authorSignature): void
    {
        $this->authorSignature = $authorSignature;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\MessageEntity[]
     */
    public function getEntities(): array
    {
        return $this->entities;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\MessageEntity[] $entities
     */
    public function setEntities(array $entities): void
    {
        $this->entities = $entities;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\MessageEntity $entity
     */
    public function addEntity(\App\Telegram\Model\Type\Base\MessageEntity $entity): void
    {
        if (is_null($this->entities)) {
            $this->entities = [];
        }
        $this->entities[] = $entity;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\MessageEntity[]
     */
    public function getCaptionEntities(): array
    {
        return $this->captionEntities;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\MessageEntity[] $captionEntities
     */
    public function setCaptionEntities(array $captionEntities): void
    {
        $this->captionEntities = $captionEntities;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\MessageEntity $captionEntity
     */
    public function addCaptionEntity(\App\Telegram\Model\Type\Base\MessageEntity $captionEntity): void
    {
        if (is_null($this->captionEntities)) {
            $this->captionEntities = [];
        }
        $this->captionEntities[] = $captionEntity;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\Audio
     */
    public function getAudio(): \App\Telegram\Model\Type\Base\Audio
    {
        return $this->audio;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\Audio $audio
     */
    public function setAudio(\App\Telegram\Model\Type\Base\Audio $audio): void
    {
        $this->audio = $audio;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\Document
     */
    public function getDocument(): \App\Telegram\Model\Type\Base\Document
    {
        return $this->document;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\Document $document
     */
    public function setDocument(\App\Telegram\Model\Type\Base\Document $document): void
    {
        $this->document = $document;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\Animation
     */
    public function getAnimation(): \App\Telegram\Model\Type\Base\Animation
    {
        return $this->animation;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\Animation $animation
     */
    public function setAnimation(\App\Telegram\Model\Type\Base\Animation $animation): void
    {
        $this->animation = $animation;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\Game
     */
    public function getGame(): \App\Telegram\Model\Type\Base\Game
    {
        return $this->game;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\Game $game
     */
    public function setGame(\App\Telegram\Model\Type\Base\Game $game): void
    {
        $this->game = $game;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\PhotoSize[]
     */
    public function getPhoto(): array
    {
        return $this->photo;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\PhotoSize[] $photo
     */
    public function setPhoto(array $photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\Sticker
     */
    public function getSticker(): \App\Telegram\Model\Type\Base\Sticker
    {
        return $this->sticker;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\Sticker $sticker
     */
    public function setSticker(\App\Telegram\Model\Type\Base\Sticker $sticker): void
    {
        $this->sticker = $sticker;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\Video
     */
    public function getVideo(): \App\Telegram\Model\Type\Base\Video
    {
        return $this->video;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\Video $video
     */
    public function setVideo(\App\Telegram\Model\Type\Base\Video $video): void
    {
        $this->video = $video;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\Voice
     */
    public function getVoice(): \App\Telegram\Model\Type\Base\Voice
    {
        return $this->voice;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\Voice $voice
     */
    public function setVoice(\App\Telegram\Model\Type\Base\Voice $voice): void
    {
        $this->voice = $voice;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\VoiceNote
     */
    public function getVoiceNote(): \App\Telegram\Model\Type\Base\VoiceNote
    {
        return $this->voiceNote;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\VoiceNote $voiceNote
     */
    public function setVoiceNote(\App\Telegram\Model\Type\Base\VoiceNote $voiceNote): void
    {
        $this->voiceNote = $voiceNote;
    }

    /**
     * @return string
     */
    public function getCaption(): string
    {
        return $this->caption;
    }

    /**
     * @param string $caption
     */
    public function setCaption(string $caption): void
    {
        $this->caption = $caption;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\Contact
     */
    public function getContact(): \App\Telegram\Model\Type\Base\Contact
    {
        return $this->contact;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\Contact $contact
     */
    public function setContact(\App\Telegram\Model\Type\Base\Contact $contact): void
    {
        $this->contact = $contact;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\Location
     */
    public function getLocation(): \App\Telegram\Model\Type\Base\Location
    {
        return $this->location;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\Location $location
     */
    public function setLocation(\App\Telegram\Model\Type\Base\Location $location): void
    {
        $this->location = $location;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\Venue
     */
    public function getVenue(): \App\Telegram\Model\Type\Base\Venue
    {
        return $this->venue;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\Venue $venue
     */
    public function setVenue(\App\Telegram\Model\Type\Base\Venue $venue): void
    {
        $this->venue = $venue;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\User
     */
    public function getNewChatMember(): \App\Telegram\Model\Type\Base\User
    {
        return $this->newChatMember;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\User $newChatMember
     */
    public function setNewChatMember(\App\Telegram\Model\Type\Base\User $newChatMember): void
    {
        $this->newChatMember = $newChatMember;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\User
     */
    public function getLeftChatMember(): \App\Telegram\Model\Type\Base\User
    {
        return $this->leftChatMember;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\User $leftChatMember
     */
    public function setLeftChatMember(\App\Telegram\Model\Type\Base\User $leftChatMember): void
    {
        $this->leftChatMember = $leftChatMember;
    }

    /**
     * @return string
     */
    public function getNewChatTitle(): string
    {
        return $this->newChatTitle;
    }

    /**
     * @param string $newChatTitle
     */
    public function setNewChatTitle(string $newChatTitle): void
    {
        $this->newChatTitle = $newChatTitle;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\PhotoSize[]
     */
    public function getNewChatPhoto(): array
    {
        return $this->newChatPhoto;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\PhotoSize[] $newChatPhoto
     */
    public function setNewChatPhoto(array $newChatPhoto): void
    {
        $this->newChatPhoto = $newChatPhoto;
    }

    /**
     * @return bool
     */
    public function isDeleteChatPhoto(): bool
    {
        return $this->deleteChatPhoto;
    }

    /**
     * @param bool $deleteChatPhoto
     */
    public function setDeleteChatPhoto(bool $deleteChatPhoto): void
    {
        $this->deleteChatPhoto = $deleteChatPhoto;
    }

    /**
     * @return bool
     */
    public function isGroupChatCreated(): bool
    {
        return $this->groupChatCreated;
    }

    /**
     * @param bool $groupChatCreated
     */
    public function setGroupChatCreated(bool $groupChatCreated): void
    {
        $this->groupChatCreated = $groupChatCreated;
    }

    /**
     * @return bool
     */
    public function isSuperGroupChatCreated(): bool
    {
        return $this->superGroupChatCreated;
    }

    /**
     * @param bool $superGroupChatCreated
     */
    public function setSuperGroupChatCreated(bool $superGroupChatCreated): void
    {
        $this->superGroupChatCreated = $superGroupChatCreated;
    }

    /**
     * @return bool
     */
    public function isChannelChatCreated(): bool
    {
        return $this->channelChatCreated;
    }

    /**
     * @param bool $channelChatCreated
     */
    public function setChannelChatCreated(bool $channelChatCreated): void
    {
        $this->channelChatCreated = $channelChatCreated;
    }

    /**
     * @return int
     */
    public function getMigrateToChatId(): int
    {
        return $this->migrateToChatId;
    }

    /**
     * @param int $migrateToChatId
     */
    public function setMigrateToChatId(int $migrateToChatId): void
    {
        $this->migrateToChatId = $migrateToChatId;
    }

    /**
     * @return int
     */
    public function getMigrateFromChatId(): int
    {
        return $this->migrateFromChatId;
    }

    /**
     * @param int $migrateFromChatId
     */
    public function setMigrateFromChatId(int $migrateFromChatId): void
    {
        $this->migrateFromChatId = $migrateFromChatId;
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
     * @return \App\Telegram\Model\Type\Base\Invoice
     */
    public function getInvoice(): \App\Telegram\Model\Type\Base\Invoice
    {
        return $this->invoice;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\Invoice $invoice
     */
    public function setInvoice(\App\Telegram\Model\Type\Base\Invoice $invoice): void
    {
        $this->invoice = $invoice;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\SuccessfulPayment
     */
    public function getSuccessfulPayment(): \App\Telegram\Model\Type\Base\SuccessfulPayment
    {
        return $this->successfulPayment;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\SuccessfulPayment $successfulPayment
     */
    public function setSuccessfulPayment(\App\Telegram\Model\Type\Base\SuccessfulPayment $successfulPayment
    ): void {
        $this->successfulPayment = $successfulPayment;
    }

    /**
     * @return string
     */
    public function getConnectedWebsite(): string
    {
        return $this->connectedWebsite;
    }

    /**
     * @param string $connectedWebsite
     */
    public function setConnectedWebsite(string $connectedWebsite): void
    {
        $this->connectedWebsite = $connectedWebsite;
    }

    /**
     * @return \App\Telegram\Model\Type\Base\PassportData
     */
    public function getPassportData(): \App\Telegram\Model\Type\Base\PassportData
    {
        return $this->passportData;
    }

    /**
     * @param \App\Telegram\Model\Type\Base\PassportData $passportData
     */
    public function setPassportData(\App\Telegram\Model\Type\Base\PassportData $passportData): void
    {
        $this->passportData = $passportData;
    }

    // ########################################
}
