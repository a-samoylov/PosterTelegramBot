<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\Update\CallbackQuery;

class Factory implements \App\Telegram\Model\Type\FactoryInterface
{
    // ########################################

    /**
     * @var \App\Telegram\Model\Type\Base\Message\Factory
     */
    private $messageFactory;

    /**
     * @var \App\Telegram\Model\Type\Base\User\Factory
     */
    private $userFactory;

    // ########################################

    public function __construct(
        \App\Telegram\Model\Type\Base\Message\Factory $messageFactory,
        \App\Telegram\Model\Type\Base\User\Factory    $userFactory
    ) {
        $this->messageFactory = $messageFactory;
        $this->userFactory    = $userFactory;
    }

    // ########################################

    public function create(array $data): \App\Telegram\Model\Type\Update\CallbackQuery
    {
        if (empty($data['update_id']) && is_int($data['update_id'])) {
            throw new \App\Model\Exception\Validate(self::class, 'update_id');
        }

        if (empty($data['callback_query']) && !is_array($data['callback_query'])) {
            throw new \App\Model\Exception\Validate(self::class, 'callback_query');
        }

        $callbackQueryData = $data['callback_query'];
        if (empty($callbackQueryData['id']) && !is_string($callbackQueryData['id'])) {
            throw new \App\Model\Exception\Validate(self::class, 'id');
        }

        if (empty($callbackQueryData['chat_instance']) && !is_string($callbackQueryData['chat_instance'])) {
            throw new \App\Model\Exception\Validate(self::class, 'chat_instance');
        }

        $result = new \App\Telegram\Model\Type\Update\CallbackQuery(
            $data['update_id'],
            $callbackQueryData['id'],
            $this->userFactory->create($callbackQueryData['from']),
            $callbackQueryData['chat_instance']
        );

        if (!empty($callbackQueryData['data'])) {
            if (!is_string($callbackQueryData['data'])) {
                throw new \App\Model\Exception\Validate(self::class, 'data');
            }
            $result->setData($callbackQueryData['data']);
        }

        !empty($callbackQueryData['message']) && $result->setMessage($this->messageFactory->create($callbackQueryData['message']));

        return $result;
    }

    // ########################################
}
