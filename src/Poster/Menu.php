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

    public function getCategory(int $id)
    {
        $url = "https://demo.joinposter.com/api/menu.getCategory?token={$this->accessToken}&category_id={$id}";

        return $this->sendRequest($url);
    }
}