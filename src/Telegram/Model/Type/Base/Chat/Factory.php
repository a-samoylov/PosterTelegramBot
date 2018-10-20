<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\Base\Chat;

class Factory implements \App\Telegram\Model\Type\FactoryInterface
{
    // ########################################

    public function create(array $data): \App\Telegram\Model\Type\Base\Chat
    {
        if (empty($data['id']) || !is_int($data['id'])) {
            throw new \App\Model\Exception\Validate(self::class, 'id');
        }

        if (empty($data['type']) || !is_string($data['type'])) {
            throw new \App\Model\Exception\Validate(self::class, 'type');
        }

        //todo other fields

        $result = new \App\Telegram\Model\Type\Base\Chat(
            $data['id'],
            $data['type']
        );

        isset($data['first_name']) && $result->setFirstName($data['first_name']);
        isset($data['last_name'])  && $result->setLastName($data['last_name']);
        isset($data['username'])   && $result->setUsername($data['username']);

        return $result;
    }

    // ########################################
}
