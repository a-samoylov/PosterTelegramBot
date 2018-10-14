<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Entity;

class Bot
{
    // ########################################

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $telegramToken;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $accessKey;

    // ########################################
}
