<?php

namespace App\Controller\Telegram;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BotController extends AbstractController
{
    /**
     * @var \App\Repository\Telegram\BotRepository
     */
    private $botRepository;

    // ########################################

    public function __construct(\App\Repository\Telegram\BotRepository $botRepository)
    {
        $this->botRepository = $botRepository;
    }

    /**
     * @Route("/telegram/bot/create/{name}/{token}", methods={"POST"}, name="telegram_bot")
     *
     * @param $name
     * @param $token
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function create($name, $token)
    {
        try {
            $accessKey = time() . bin2hex(random_bytes(20));
            $this->botRepository->create($name, $token, $accessKey);
        } catch (\Exception $exception) {
            return $this->json([
                'success' => false
            ]);
        }


        return $this->json([
            'success' => true
        ]);
    }

    // ########################################
}
