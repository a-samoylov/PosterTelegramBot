<?php

namespace App\Repository\Telegram;

use App\Entity\Telegram\Chat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Chat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chat[]    findAll()
 * @method Chat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChatRepository extends ServiceEntityRepository
{
    // ########################################

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Chat::class);
    }

    // ########################################

    public function create(
        int     $chatId,
        string  $type,
        ?string $username,
        ?string $firstName,
        ?string $lastName
    ): Chat {
        $chat = new Chat();

        $chat->setId($chatId);

        switch ($type) {
            case \App\Entity\Telegram\Chat::TYPE_PRIVATE:
                $chat->setTypePrivate();
                break;
            case \App\Entity\Telegram\Chat::TYPE_GROUP:
                $chat->setTypeGroup();
                break;
            case \App\Entity\Telegram\Chat::TYPE_SUPERGROUP:
                $chat->setTypeSupergroup();
                break;
            case \App\Entity\Telegram\Chat::TYPE_CHANNEL:
                $chat->setTypeChannel();
                break;
        }

        !is_null($username)  && $chat->setUsername($username);
        !is_null($firstName) && $chat->setFirstName($firstName);
        !is_null($lastName)  && $chat->setLastName($lastName);

        $this->getEntityManager()->persist($chat);
        $this->getEntityManager()->flush($chat);

        return $chat;
    }

    // ########################################
}
