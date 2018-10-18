<?php

declare(strict_types=1);

namespace App\Poster;

class Auth
{
    private $applicationId;

    private $applicationSecret;

    private $redirectUrl;

    public function __construct(int $applicationId, string $applicationSecret, string $redirectUrl)
    {
        $this->applicationId     = $applicationId;
        $this->applicationSecret = $applicationSecret;
        $this->redirectUrl       = $redirectUrl;
    }

    public function getAccessToken(string $account, string $code): string
    {
        $params = [
            'code'               => $code,
            'application_id'     => $this->applicationId,
            'application_secret' => $this->applicationSecret,
            'redirect_url'       => $this->redirectUrl,
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

        $data = curl_exec($ch);
        curl_close($ch);

        return $data['access_token'];
    }

    public function getPosterOAuthUrl(): string
    {
        return "https://joinposter.com/api/auth?application_id={$this->applicationId}&redirect_uri={$this->redirectUrl}&response_type=code";
    }
}