<?php

declare(strict_types=1);

namespace App\Poster;

class Menu extends Api
{
    public function getCategories()
    {
        $url = "https://{$this->account}.joinposter.com/api/menu.getCategories?token={$this->accessToken}";

        return $this->sendRequest($url);
    }

    public function getProducts(int $categoryId)
    {
        $url = "https://{$this->account}.joinposter.com/api/menu.getProducts?token={$this->accessToken}&category_id={$categoryId}";

        return $this->sendRequest($url);
    }
}
