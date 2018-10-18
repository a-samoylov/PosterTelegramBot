<?php

namespace App\Controller\Telegram;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
    public function createBot(
        $name,
        $token,
        \App\Repository\Telegram\BotRepository $botRepository
    ) {
        try {
            $accessKey = time() . bin2hex(random_bytes(20));
            $botRepository->create($name, $token, $accessKey);
        } catch (\Exception $exception) {
            return $this->json(['success' => false]);
        }

        return $this->json(['success' => true]);
    }

    // ########################################

    /**
     * @Route("/telegram/bot/get/{id}", methods={"GET"}, name="telegram_bot_get")
     *
     * @param                                        $id
     * @param \App\Repository\Telegram\BotRepository $botRepository
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getBot($id, \App\Repository\Telegram\BotRepository $botRepository)
    {
        $bot = $botRepository->find((int)$id);
        if (is_null($bot)) {
            return $this->json([]);
        }

        return $this->json([
            'id'       => $bot->getId(),
            'name'     => $bot->getName(),
            'token'    => $bot->getToken(),
            'settings' => json_encode($bot->getSettings())
        ]);
    }

    // ########################################

    /**
     * @Route("/telegram/bot/set/settings/{id}", methods={"PUT"}, name="telegram_bot_set_settings")
     *
     * @param string                                 $id
     * @param \App\Repository\Telegram\BotRepository $botRepository
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function setBotSettings(
        $id,
        \App\Repository\Telegram\BotRepository $botRepository
    ) {
        $bot = $botRepository->find((int)$id);
        if (is_null($bot)) {
            return $this->json(['success' => false]);
        }

        $request  = Request::createFromGlobals();
        $settings = (array)json_decode($request->getContent(), true);

        //todo validate
        $bot->setSettings($settings);
        $botRepository->update($bot);

        return $this->json(['success' => true]);
    }

    // ########################################

    /**
     * @Route("/telegram/bot/generate/{id}", methods={"PUT"}, name="telegram_bot_generate")
     *
     * @param string                                 $id
     * @param \App\Repository\Telegram\BotRepository $botRepository
     * @param \App\Telegram\Bot\BotGenerator         $botGenerator
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function generate(
        $id,
        \App\Repository\Telegram\BotRepository $botRepository,
        \App\Telegram\Bot\BotGenerator         $botGenerator
    ) {
        $bot = $botRepository->find((int)$id);
        if (is_null($bot)) {
            return $this->json(['success' => false]);
        }

        try {
            $botGenerator->generate($bot);
        } catch (\Exception $exception) {
            return $this->json(['success' => false]);
        }

        return $this->json(['success' => true]);
    }

    // ########################################
}
