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

        $categoriesResponse = $menuApi->getCategories()['response'];

        $categories = [];

        foreach ($categoriesResponse as $categoryResponse) {
            $productsResponse = $menuApi->getProducts((int)$categoryResponse['category_id'])['response'];

            $products = [];

            foreach ($productsResponse as $productResponse) {
                $price = $productResponse['price'];
                $price = array_shift($price);

                $photo = 'https://joinposter.com' . $productResponse['photo_origin'];

                $products[] = new \App\Entity\User\Poster\Product
                ((int)$productResponse['product_id'], $productResponse['product_name'], (int)$price, $photo);
            }

            $categories[$categoryResponse['category_id']] = [
                'name'            => $categoryResponse['category_name'],
                'parent_category' => $categoryResponse['parent_category'],
                'products'        => $products,
            ];
        }

        $user->setPosterMenu(new \App\Entity\User\Poster\Menu($this->getSubCategories(0, $categories)));

        $spotsApi = new \App\Poster\Spots($user);

        $spotId = (int)$spotsApi->getSpotsTablesHalls()['response'][0]['spot_id'];

        $user->setPosterSpotId($spotId);

        $userRepository->save($user);
        //        return $this->redirectToRoute('index');
    }

    private function getSubCategories(int $parentCategoryId, array $categories): array
    {
        $subCategories = [];

        foreach ($categories as $id => $category) {
            if ($category['parent_category'] != $parentCategoryId) {
                continue;
            }

            $subCategories[] = new \App\Entity\User\Poster\Category($id, $category['name'], $this->getSubCategories($id, $categories),
                                                                    $category['products']);
        }

        return $subCategories;
    }
}
