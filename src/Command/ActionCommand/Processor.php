<?php

/**
 * @author     School Assistant Developers Team
 * @copyright  2018-2018 School Assistant
 * @license    Any usage is forbidden
 */

namespace App\Command\ActionCommand;

class Processor
{
    /**
     * @var \Psr\Container\ContainerInterface
     */
    private $container;

    /**
     * @var \App\Command\Response\Factory
     */
    private $responseFactory;

    /**
     * @var \App\Command\ActionCommand\Resolver
     */
    private $resolver;

    // ########################################

    public function __construct(
        \Psr\Container\ContainerInterface   $container,
        \App\Command\Response\Factory       $responseFactory,
        \App\Command\ActionCommand\Resolver $resolver
    ) {
        $this->container       = $container;
        $this->responseFactory = $responseFactory;
        $this->resolver        = $resolver;
    }

    // ########################################

    /**
     * @param \App\Command\ActionCommand\Action $action
     *
     * @return \App\Command\Response
     */
    public function process(\App\Command\ActionCommand\Action $action) {
        /** @var string $serviceName */
        $serviceName = $this->resolver->resolve($action->getCommand());

        /** @var \App\Command\BaseAbstract $command */
        $command = $this->container->get($serviceName);


        return $command->run();
    }

    // ########################################
}
