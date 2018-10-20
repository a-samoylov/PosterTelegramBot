<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\Base\Message;

class Factory implements \App\Telegram\Model\Type\FactoryInterface
{
    // ########################################

    /**
     * @var \App\Telegram\Model\Type\Base\User\Factory
     */
    private $userFactory;

    /**
     * @var \App\Telegram\Model\Type\Base\Chat\Factory
     */
    private $chatFactory;

    /**
     * @var \App\Model\Helper\DateTime
     */
    private $dateTimeHelper;

    /**
     * @var \App\Telegram\Model\Type\Base\MessageEntity\Factory
     */
    private $messageEntityFactory;

    public function __construct(
        \App\Telegram\Model\Type\Base\User\Factory          $userFactory,
        \App\Telegram\Model\Type\Base\Chat\Factory          $chatFactory,
        \App\Model\Helper\DateTime                          $dateTimeHelper,
        \App\Telegram\Model\Type\Base\MessageEntity\Factory $messageEntityFactory
    ) {
        $this->userFactory          = $userFactory;
        $this->chatFactory          = $chatFactory;
        $this->dateTimeHelper       = $dateTimeHelper;
        $this->messageEntityFactory = $messageEntityFactory;
    }

    // ########################################

    public function create(array $data): \App\Telegram\Model\Type\Base\Message
    {
        if (empty($data['message_id']) || !is_int($data['message_id'])) {
            throw new \App\Model\Exception\Validate(self::class, 'message_id', $data);
        }

        if (empty($data['date']) || !is_int($data['date'])) {
            throw new \App\Model\Exception\Validate(self::class, 'date', $data);
        }

        if (empty($data['chat'])) {
            throw new \App\Model\Exception\Validate(self::class, 'chat', $data);
        }

        $result = new \App\Telegram\Model\Type\Base\Message(
            $data['message_id'],
            $this->dateTimeHelper->create($data['date']),
            $this->chatFactory->create($data['chat'])
        );

        if (!empty($data['from'])) {
            $result->setFrom($this->userFactory->create($data['from']));
        }

        if (!empty($data['forward_from'])) {
            $result->setForwardFrom($this->userFactory->create($data['forward_from']));
        }

        if (!empty($data['forward_from_chat'])) {
            $result->setForwardFromChat($this->chatFactory->create($data['forward_from_chat']));
        }

        if (!empty($data['forward_from_message_id'])) {
            if (!is_int($data['forward_from_message_id'])) {
                throw new \App\Model\Exception\Validate(self::class, 'forward_from_message_id', $data);
            }
            $result->setForwardFromMessageId($data['forward_from_message_id']);
        }

        if (!empty($data['forward_signature'])) {
            if (!is_string($data['forward_signature'])) {
                throw new \App\Model\Exception\Validate(self::class, 'forward_signature', $data);
            }
            $result->setForwardSignature($data['forward_signature']);
        }

        if (!empty($data['forward_date'])) {
            if (!is_int($data['forward_date'])) {
                throw new \App\Model\Exception\Validate(self::class, 'forward_date', $data);
            }
            $result->setForwardDate($this->dateTimeHelper->create($data['forward_date']));
        }

        if (!empty($data['reply_to_message'])) {
            $result->setReplyToMessage($this->create($data['reply_to_message']));
        }

        if (!empty($data['edit_date'])) {
            if (!is_int($data['edit_date'])) {
                throw new \App\Model\Exception\Validate(self::class, 'edit_date', $data);
            }
            $result->setEditDate($this->dateTimeHelper->create($data['edit_date']));
        }

        if (!empty($data['media_group_id'])) {
            if (!is_string($data['media_group_id'])) {
                throw new \App\Model\Exception\Validate(self::class, 'media_group_id', $data);
            }
            $result->setMediaGroupId($data['media_group_id']);
        }

        if (!empty($data['author_signature'])) {
            if (!is_string($data['author_signature'])) {
                throw new \App\Model\Exception\Validate(self::class, 'author_signature', $data);
            }
            $result->setAuthorSignature($data['author_signature']);
        }

        if (!empty($data['text'])) {
            if (!is_string($data['text'])) {
                throw new \App\Model\Exception\Validate(self::class, 'text', $data);
            }
            $result->setText($data['text']);
        }

        if (!empty($data['entities'])) {
            if (!is_array($data['entities'])) {
                throw new \App\Model\Exception\Validate(self::class, 'entities', $data);
            }

            foreach ($data['entities'] as $entityData) {
                $result->addEntity($this->messageEntityFactory->create($entityData));
            }
        }

        if (!empty($data['caption_entities'])) {
            if (!is_array($data['caption_entities'])) {
                throw new \App\Model\Exception\Validate(self::class, 'caption_entities', $data);
            }

            foreach ($data['caption_entities'] as $captionEntityData) {
                $result->addCaptionEntity($this->messageEntityFactory->create($captionEntityData));
            }
        }

        //todo other

        return $result;
    }

    // ########################################
}
