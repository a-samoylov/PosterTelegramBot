<?php

declare(strict_types=1);

namespace App\Poster;

class IncomingOrders extends Api
{
    public function createIncomingOrder(int $spotId, string $phone, array $products)
    {
        $url = "https://demo.joinposter.com/api/incomingOrders.createIncomingOrder?token={$this->accessToken}";

        $params = [
            'spot_id'  => $spotId,
            'phone'    => $phone,
            'products' => $products,
        ];

        return $this->sendRequest($url, 'post', $params);
    }
}