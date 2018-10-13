<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\Base\MessageEntity;

use App\Model\Exception\Validate as ValidateException;
use App\Telegram\Model\Type\Base\MessageEntity;
use App\Telegram\Model\Type\FactoryInterface;
use App\Telegram\Model\Type\Base\User\Factory as UserFactory;

class Factory implements FactoryInterface
{
    /**
     * @var \App\Telegram\Model\Type\Base\User\Factory
     */
    private $userFactory;

    // ########################################

    public function __construct(UserFactory $userFactory)
    {
        $this->userFactory = $userFactory;
    }

    // ########################################

    public function create(array $data): MessageEntity
    {
        if (empty($data['type']) || !is_string($data['type'])) {
            throw new ValidateException(self::class, 'type', $data);
        }

        if (!isset($data['offset']) || !is_int($data['offset'])) {
            throw new ValidateException(self::class, 'offset', $data);
        }

        if (!isset($data['length']) || !is_int($data['length'])) {
            throw new ValidateException(self::class, 'length', $data);
        }

        $result = new MessageEntity($data['type'], $data['offset'], $data['length']);
        if (!empty($data['url'])) {
            if (!is_string($data['url'])) {
                throw new ValidateException(self::class, 'url', $data);
            }
            $result->setUrl($data['url']);
        }

        if (!empty($data['user'])) {
            $result->setUser($this->userFactory->create($data['user']));
        }

        return $result;
    }

    // ########################################
}
