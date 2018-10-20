<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method \App\Entity\User|null find($id, $lockMode = null, $lockVersion = null)
 * @method \App\Entity\User|null findOneBy(array $criteria, array $orderBy = null)
 * @method \App\Entity\User[]    findAll()
 * @method \App\Entity\User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    // ########################################

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, \App\Entity\User::class);
    }

    public function save(User $user)
    {
        $this->getEntityManager()->flush($user);
    }
    // ########################################
}
