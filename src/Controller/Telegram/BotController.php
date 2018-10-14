<?php

namespace App\Controller\Telegram;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BotController extends AbstractController
{
    // ########################################

    /**
     * @Route("/telegram/bot/create/{name}/{token}", methods={"POST"}, name="telegram_bot_create")
     *
     * @param string                                 $name
     * @param string                                 $token
     * @param \App\Repository\Telegram\BotRepository $botRepository
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function create(
        $name,
        $token,
        \App\Repository\Telegram\BotRepository $botRepository
    ) {
        try {
            $accessKey = time() . bin2hex(random_bytes(20));
            $botRepository->create($name, $token, $accessKey);
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
