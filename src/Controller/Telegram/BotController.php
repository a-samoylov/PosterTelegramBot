<?php

namespace App\Controller\Telegram;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/telegram/bot/create/{name}", methods={"POST"}, name="telegram_bot")
     *
     * @param $name
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function create($name)
    {
        $request   = Request::createFromGlobals();
        $token     = $request->getContent();
        $accessKey = time() . bin2hex(random_bytes(20));

        $this->botRepository->create($name, $token, $accessKey);

        return $this->json([
            'success' => true
        ]);
    }

    // ########################################
}
