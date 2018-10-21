<?php

declare(strict_types=1);

namespace App\Poster;

class Auth
{
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function getAccessToken(string $account, string $code): string
    {
        $params = [
            'code'               => $code,
            'application_id'     => $this->config->getApplicationId(),
            'application_secret' => $this->config->getApplicationSecret(),
            'redirect_uri'       => $this->config->getRedirectUrl(),
            'grant_type'         => 'authorization_code',
        ];

        $url = "https://{$account}.joinposter.com/api/auth/access_token";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Poster (http://joinposter.com)');

        $data = json_decode(curl_exec($ch), true);
        curl_close($ch);

        return $data['new_access_token'];
    }

    public function getPosterOAuthUrl(): string
    {
        return "https://joinposter.com/api/auth?application_id={$this->config->getApplicationId()}&redirect_uri={$this->config->getRedirectUrl()}&response_type=code";
    }
}
