<?php

declare(strict_types=1);

namespace App\Controller\Poster;

use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("poster/", name="poster_")
 */
class OAuth extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @Route("oauth/callback", name="oauth_callback")
     */
    public function oAuthCallback(
        \Symfony\Component\HttpFoundation\Request $request,
        \App\Repository\UserRepository $userRepository,
        \App\Poster\Auth $posterAuth
    ): \Symfony\Component\HttpFoundation\Response {
        $code    = $request->query->get('code');
        $account = $request->query->get('account');

        $user = $userRepository->find($request->getSession()->get('USER_ID'));

        $user->setPosterAccount($account);
        $user->setPosterAccessKey($posterAuth->getAccessToken($account, $code));

        $userRepository->save($user);

        return $this->redirectToRoute('index');
    }

}