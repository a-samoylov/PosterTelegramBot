<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Type\Base\User;

use App\Model\Exception\Validate as ValidateException;
use App\Telegram\Model\Type\FactoryInterface;

class Factory implements FactoryInterface
{
    // ########################################

    public function create(array $data): \App\Telegram\Model\Type\Base\User
    {
        if (empty($data['id']) || !is_int($data['id'])) {
            throw new ValidateException(self::class, 'id');
        }

        if (!isset($data['is_bot']) || !is_bool($data['is_bot'])) {
            throw new ValidateException(self::class, 'id');
        }

        if (empty($data['first_name']) || !is_string($data['first_name'])) {
            throw new ValidateException(self::class, 'first_name');
        }

        $result = new \App\Telegram\Model\Type\Base\User(
            $data['id'],
            $data['is_bot'],
            $data['first_name']
        );

        if (!empty($data['last_name'])) {
            if (!is_string($data['last_name'])) {
                throw new ValidateException(self::class, 'last_name');
            }
            $result->setLastName($data['last_name']);
        }

        if (!empty($data['username'])) {
            if (!is_string($data['username'])) {
                throw new ValidateException(self::class, 'username');
            }
            $result->setUsername($data['username']);
        }

        $languageCode = null;
        if (!empty($data['language_code'])) {
            if (!is_string($data['language_code'])) {
                throw new ValidateException(self::class, 'language_code');
            }
            $result->setLanguageCode($data['language_code']);
        }

        return $result;
    }

    // ########################################
}
