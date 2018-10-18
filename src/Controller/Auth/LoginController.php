<?php

declare(strict_types=1);

namespace App\Controller\Auth;

use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("auth/", name="auth_")
 */
class LoginController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @Route("login", name="login")
     */
    public function login(\Symfony\Component\Security\Http\Authentication\AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'auth/login.html.twig',
            array(
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }
}