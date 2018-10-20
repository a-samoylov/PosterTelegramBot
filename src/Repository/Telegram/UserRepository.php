<?php

namespace App\Repository\Telegram;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method \App\Entity\Telegram\User|null find($id, $lockMode = null, $lockVersion = null)
 * @method \App\Entity\Telegram\User|null findOneBy(array $criteria, array $orderBy = null)
 * @method \App\Entity\Telegram\User[]    findAll()
 * @method \App\Entity\Telegram\User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    // ########################################

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, \App\Entity\Telegram\User::class);
    }

    // ########################################

    public function create(\App\Entity\Telegram\Chat $telegramChat)
    {
        $user = new \App\Entity\Telegram\User();

        $user->setChat($telegramChat);

        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush($user);

        return $user;
    }

    public function save(\App\Entity\Telegram\User $user)
    {
        $this->getEntityManager()->flush($user);
    }

    public function findByChat(\App\Entity\Telegram\Chat $chat): ?\App\Entity\Telegram\User
    {
        return $this->createQueryBuilder('user')
                    ->andWhere('user.chat = :chat')
                    ->setParameter('chat', $chat)
                    ->getQuery()
                    ->getOneOrNullResult();
    }

    // ########################################
}
