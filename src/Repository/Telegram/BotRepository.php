<?php

namespace App\Repository\Telegram;

use App\Entity\Telegram\Bot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Bot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bot[]    findAll()
 * @method Bot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BotRepository extends ServiceEntityRepository
{
    // ########################################

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Bot::class);
    }

    // ########################################

    public function create(string $name, string $token, string $accessKey)
    {
        $bot = new Bot();

        $bot->setName($name);
        $bot->setToken($token);
        $bot->setAccessKey($accessKey);

        $this->getEntityManager()->persist($bot);
        $this->getEntityManager()->flush($bot);

        return $bot;
    }

    public function update(\App\Entity\Telegram\Bot $bot)
    {
        $this->getEntityManager()->flush($bot);

        return $bot;
    }

    // ########################################
}
