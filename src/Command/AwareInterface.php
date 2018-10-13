<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 27.09.2018
 * Time: 23:13
 */

namespace App\Command;

interface AwareInterface
{
    // ########################################

    public function setContainer(\Psr\Container\ContainerInterface $container);

    public function setResponseFactory(Response\Factory $responseFactory);

    public function setUpdate(\App\Telegram\Model\Type\Update\BaseAbstract $update);

    // ########################################
}
