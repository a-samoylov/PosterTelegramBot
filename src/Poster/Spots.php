<?php

declare(strict_types=1);

namespace App\Poster;

class Spots extends Api
{
    public function getSpotsTablesHalls()
    {
        $url = "https://demo.joinposter.com/api/spots.getSpotTablesHalls?token={$this->accessToken}";

        return $this->sendRequest($url);
    }

    public function getTableHallTables(int $spotId, int $hallId)
    {
        $url = "https://demo.joinposter.com/api/spots.getTableHallTables?token={$this->accessToken}&spot_id={$spotId}&hall_id={$hallId}&without_deleted=1";

        return $this->sendRequest($url);
    }
}