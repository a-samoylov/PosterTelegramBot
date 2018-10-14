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
     * @Route("/telegram/bot/create/", methods={"GET"}, name="telegram_bot")
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function create()
    {
        //TODO post + name and token in params

        $name = 'Bot Name';
        $token = '555677621:AAEBmA5NI8psavI-7IibsXek09QqBd_dFkE';

        $hash = bin2hex(random_bytes(20));

        $this->botRepository->create($name, $token, $hash);

        return $this->json([
            'success' => true
        ]);
    }

    // ########################################
}
