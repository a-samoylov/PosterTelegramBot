<?php

declare(strict_types=1);

namespace App\Poster;

class IncomingOrders extends Api
{
    public function createIncomingOrder(int $spotId, string $phone, array $products)
    {
        $url = "https://{$this->account}.joinposter.com/api/incomingOrders.createIncomingOrder?token={$this->accessToken}";

        $params = [
            'spot_id'  => $spotId,
            'phone'    => $phone,
            'products' => $products,
        ];

        return $this->sendRequest($url, 'post', $params);
    }

    /**
     * @param int       $spotId
     * @param \DateTime $dateReservation
     * @param int       $duration
     *
     * @param int       $guestsCount
     *
     * @return \App\Poster\Table[]
     */
    public function getTablesForReservation(int $spotId, \DateTime $dateReservation, int $duration, int $guestsCount): array
    {
        $url = "https://{$this->account}.joinposter.com/api/incomingOrders.getTablesForReservation?token={$this->accessToken}&date_reservation={$dateReservation->format('Y-m-d H:i:s')}&duration={$duration}&spot_id={$spotId}&guests_count={$guestsCount}";

        $freeTablesResponse = $this->sendRequest($url)['response']['freeTables'];

        $freeTables = [];

        foreach ($freeTablesResponse as $freeTableResponse) {
            $freeTables[] = new Table((int)$freeTableResponse['table_id'], (int)$freeTableResponse['table_num']);
        }

        return $freeTables;
    }

    public function createReservation(
        int $spotId,
        string $phone,
        int $tableId,
        int $guestsCount,
        int $duration,
        \DateTime $dateReservation
    ) {
        $url = "https://{$this->account}.joinposter.com/api/incomingOrders.createReservation?token={$this->accessToken}";

        $reservation = [
            'spot_id'          => $spotId,
            'phone'            => $phone,
            'table_id'         => $tableId,
            'guests_count'     => $guestsCount,
            'duration'         => $duration,
            'date_reservation' => $dateReservation->format('Y-m-d H:i:s')
        ];

        return $this->sendRequest($url, 'post', $reservation);
    }
}
