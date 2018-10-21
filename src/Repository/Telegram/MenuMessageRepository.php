<?php

namespace App\Repository\Telegram;

use App\Entity\Telegram\MenuMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MenuMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method MenuMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method MenuMessage[]    findAll()
 * @method MenuMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MenuMessageRepository extends ServiceEntityRepository
{
    // ########################################

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MenuMessage::class);
    }

    // ########################################

    public function create(
        \App\Entity\Telegram\Bot $bot,
        \App\Entity\Telegram\Layout $layout,
        string $buttonText,
        array $action
    ): MenuMessage {
        $menuMessage = new MenuMessage();

        $menuMessage->setBot($bot);
        $menuMessage->setLayout($layout);
        $menuMessage->setButtonText($buttonText);
        $menuMessage->setActions($action);

        $this->getEntityManager()->persist($menuMessage);
        $this->getEntityManager()->flush($menuMessage);

        return $menuMessage;
    }

    // ########################################
}
