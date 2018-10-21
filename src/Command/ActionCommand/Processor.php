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
     * @var \App\Command\ActionCommand\Resolver
     */
    private $resolver;

    // ########################################

    public function __construct(
        \Psr\Container\ContainerInterface   $container,
        \App\Command\ActionCommand\Resolver $resolver
    ) {
        $this->container       = $container;
        $this->resolver        = $resolver;
    }

    // ########################################

    /**
     * @param \App\Command\ActionCommand\Action $action
     */
    public function process(\App\Command\ActionCommand\Action $action) {
        /** @var string $serviceName */
        $serviceName = $this->resolver->resolve($action->getCommand());
        if (is_null($serviceName)) {
            return;
        }

        /** @var \App\Command\ActionCommand\BaseAbstract $command */
        $command = $this->container->get($serviceName);
        $command->run($action->getParams());
    }

    // ########################################
}
