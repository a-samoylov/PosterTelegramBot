<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Command;

class Processor
{
    /**
     * @var \App\Config\Telegram
     */
    private $telegramConfigs;

    /**
     * @var \Psr\Container\ContainerInterface
     */
    private $container;

    /**
     * @var \App\Command\ServiceResolver
     */
    private $serviceResolver;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @var \App\Command\Response\Factory
     */
    private $responseFactory;

    // ########################################

    public function __construct(
        \App\Config\Telegram              $telegramConfigs,
        \Psr\Container\ContainerInterface $container,
        \App\Command\ServiceResolver      $serviceResolver,
        \Psr\Log\LoggerInterface          $logger,
        \App\Command\Response\Factory     $responseFactory
    ) {
        $this->telegramConfigs = $telegramConfigs;
        $this->container       = $container;
        $this->serviceResolver = $serviceResolver;
        $this->logger          = $logger;
        $this->responseFactory = $responseFactory;
    }

    // ########################################

    /**
     * @param \App\Entity\Telegram\Bot                     $bot
     * @param \App\Telegram\Model\Type\Update\BaseAbstract $update
     *
     * @return \App\Command\Response
     */
    public function process(
        \App\Entity\Telegram\Bot                     $bot,
        \App\Telegram\Model\Type\Update\BaseAbstract $update
    ) {
        /** @var string $serviceName */
        $serviceName = $this->serviceResolver->resolve($update);

        /** @var \App\Command\BaseAbstract $command */
        $command = $this->container->get($serviceName);
        $command->setBot($bot);
        $command->setUpdate($update);
        $command->setResponseFactory($this->responseFactory);
        $command->setContainer($this->container);

        return $command->run();
    }

    // ########################################
}
