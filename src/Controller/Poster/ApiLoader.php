<?php

declare(strict_types=1);

namespace App\Controller\Poster;

use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/poster", name="poster_")
 */
class ApiLoader extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @Route("/load_data", name="load_data")
     */
    public function loadData(
        \App\Repository\UserRepository $userRepository
    ): \Symfony\Component\HttpFoundation\Response {
        $user = $userRepository->find(1);

        $menuApi = new \App\Poster\Menu($user);

        $productsResponse = $menuApi->getProducts();

        dump($productsResponse);

        $productsResponse = $productsResponse['response'];

        $categories = [];

        foreach ($productsResponse as $product) {
            $categories[$product['menu_category_id']] = [
                'name'     => $product['category_name'],
                'products' => []
            ];
        }

        foreach ($productsResponse as $product) {
            $price = $product['price'];
            $price = array_shift($price);

            $photo = 'https://joinposter.com' . $product['photo_origin'];

            $categories[$product['menu_category_id']]['products'][] = new \App\Entity\User\Poster\Product((int)$product['product_id'],
                                                                                                          $product['product_name'],
                                                                                                          (int)$price, $photo);
        }

        $categoryObjects = [];

        foreach ($categories as $id => $category) {
            $categoryObjects[] = new \App\Entity\User\Poster\Category($id, $category['name'], $category['products']);
        }

        $user->setPosterMenu(new \App\Entity\User\Poster\Menu($categoryObjects));

        $userRepository->save($user);

        return $this->redirectToRoute('index');
    }

}
