<?php

namespace App\Repository\Telegram;

use App\Entity\Telegram\SendCallbackMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SendCallbackMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method SendCallbackMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method SendCallbackMessage[]    findAll()
 * @method SendCallbackMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SendCallbackMessageRepository extends ServiceEntityRepository
{
    // ########################################

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SendCallbackMessage::class);
    }

    // ########################################

    public function create(): SendCallbackMessage
    {
        //todo
    }

    // ########################################
}
