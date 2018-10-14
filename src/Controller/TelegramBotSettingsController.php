<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TelegramBotSettingsController extends AbstractController
{
    // ########################################

    /**
     * @Route("/settings/add", name="settings_controller")
     */
    public function index()
    {
        return $this->json('asdasd');
    }

    // ########################################

    public function updateTemplatesSettings()
    {
        return $this->json([]);
    }

    // ########################################
}
