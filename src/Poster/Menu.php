<?php

declare(strict_types=1);

namespace App\Poster;

class Menu extends Api
{
    public function getCategories()
    {
        $url = "https://demo.joinposter.com/api/menu.getCategories?token={$this->accessToken}";

        return $this->sendRequest($url);
    }

    public function getProducts()
    {
        $url = "https://demo.joinposter.com/api/menu.getProducts?token={$this->accessToken}";

        return $this->sendRequest($url);
    }
}
