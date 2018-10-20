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

    public function create(\App\Telegram\Bot\BotGenerator\Settings\Layout $settingsLayout): Layout {
        $layout = new Layout();

        $layout->setBot($settingsLayout->getBot());
        $layout->setName($settingsLayout->getName());
        $layout->setText($settingsLayout->getText());

        if ($settingsLayout->isHasReplyMarkupInlineKeyboard()) {

            /** @var \App\Telegram\Model\Type\ReplyMarkup\InlineKeyboardMarkup $inlineKeyboard */
            $inlineKeyboard = $settingsLayout->getReplyMarkup();
            /*$layout->setReplyMarkup([
                'type' => \App\Telegram\Bot\BotGenerator\Settings::TYPE_REPLY_INLINE_KEYBOARD_MARKUP;
                'text' => $inlineKeyboard
            ]);*/
        }

        $this->getEntityManager()->persist($layout);
        $this->getEntityManager()->flush($layout);

        return $layout;
    }

    // ########################################
}
