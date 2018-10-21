<?php

namespace App\Repository\Telegram;

use App\Entity\Telegram\CallbackMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CallbackMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method CallbackMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method CallbackMessage[]    findAll()
 * @method CallbackMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CallbackMessageRepository extends ServiceEntityRepository
{
    // ########################################

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CallbackMessage::class);
    }

    // ########################################

    public function create(
        \App\Entity\Telegram\Bot    $bot,
        \App\Entity\Telegram\Layout $layout,
        int $buttonId,
        array $action
    ): CallbackMessage {
        $callbackMessage = new CallbackMessage();

        $callbackMessage->setBot($bot);
        $callbackMessage->setLayout($layout);
        $callbackMessage->setButtonId($buttonId);
        $callbackMessage->setActions($action);

        $this->getEntityManager()->persist($callbackMessage);
        $this->getEntityManager()->flush($callbackMessage);

        return $callbackMessage;
    }

    // ########################################
}
