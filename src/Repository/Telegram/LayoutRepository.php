<?php

namespace App\Repository\Telegram;

use App\Entity\Telegram\Layout;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Layout|null find($id, $lockMode = null, $lockVersion = null)
 * @method Layout|null findOneBy(array $criteria, array $orderBy = null)
 * @method Layout[]    findAll()
 * @method Layout[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LayoutRepository extends ServiceEntityRepository
{
    // ########################################

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Layout::class);
    }

    // ########################################

    public function create(
        \App\Entity\Telegram\Bot                          $bot,
        string                                            $name,
        string                                            $text,
        \App\Telegram\Model\Type\ReplyMarkup\BaseAbstract $replayMarkup
    ): Layout {
        $layout = new Layout();

        $layout->setBot($bot);
        $layout->setName($name);
        $layout->setText($text);

        $this->getEntityManager()->persist($layout);
        $this->getEntityManager()->flush($layout);

        return $layout;
    }

    // ########################################
}
