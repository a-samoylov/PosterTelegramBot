<?php

declare(strict_types=1);

namespace App\Poster;

class Spots extends Api
{
    public function getSpotsTablesHalls()
    {
        $url = "https://{$this->account}.joinposter.com/api/spots.getSpotTablesHalls?token={$this->accessToken}";

        return $this->sendRequest($url);
    }
}
