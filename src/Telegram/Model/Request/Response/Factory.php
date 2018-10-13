<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Telegram\Model\Request\Response;

class Factory
{
    // ########################################

    public function createSuccessResponse(array $data): Success
    {
        return new Success($data);
    }

    public function createFailedResponse(int $errorCode, string $description = null): Failed
    {
        return new Failed($errorCode, $description);
    }

    // ########################################
}
