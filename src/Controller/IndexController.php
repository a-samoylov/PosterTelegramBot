<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\Event;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(\App\Repository\UserRepository $userRepository)
    {
        $a = $userRepository->find(1);

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
