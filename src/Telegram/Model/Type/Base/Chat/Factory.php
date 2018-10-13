<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\Base\Chat;

use App\Model\Exception\Validate as ValidateException;
use App\Telegram\Model\Type\Base\Chat;
use App\Telegram\Model\Type\FactoryInterface;

class Factory implements FactoryInterface
{
    // ########################################

    public function create(array $data): Chat
    {
        if (empty($data['id']) || !is_int($data['id'])) {
            throw new ValidateException(self::class, 'id');
        }

        if (empty($data['type']) || !is_string($data['type'])) {
            throw new ValidateException(self::class, 'type');
        }

        //todo other fields

        return new Chat(
            $data['id'],
            $data['type']
        );
    }

    // ########################################
}
