<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 10.09.2018
 * Time: 00:12
 */

namespace App\Command;

abstract class BaseAbstract implements AwareInterface
{
    // ########################################

    /**
     * @var \App\Command\Response\Factory
     */
    private $responseFactory;

    /**
     * @var \App\Telegram\Model\Type\Update\BaseAbstract
     */
    private $update;

    /**
     * @var \Psr\Container\ContainerInterface
     */
    private $container;

    /**
     * @var \App\Entity\Telegram\Bot
     */
    private $bot;

    // ########################################

    public function setResponseFactory(Response\Factory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    // ########################################

    public function processAnotherCommand(string $serviceName)
    {
        /** @var \App\Command\BaseAbstract $command */
        $command = $this->container->get($serviceName);
        $command->setUpdate($this->getUpdate());
        $command->setResponseFactory($this->responseFactory);
        $command->setContainer($this->container);

        return $command->run();
    }

    // ########################################

    /**
     * @return string|bool
     */
    abstract public function validate();

    abstract public function processCommand(): void;

    // ----------------------------------------

    public function run()
    {
        $trueOrMessage = $this->validate();

        if ($trueOrMessage !== true) {
            return $this->createFailedResponse($trueOrMessage);
        }

        $this->processCommand();

        return $this->createSuccessResponse();
    }

    // ########################################

    public function createSuccessResponse(): Response
    {
        return $this->responseFactory->create();
    }

    public function createFailedResponse(string $message): Response
    {
        return $this->responseFactory->create(false, $message);
    }

    // ########################################

    /**
     * @return \App\Telegram\Model\Type\Update\BaseAbstract
     */
    public function getUpdate(): \App\Telegram\Model\Type\Update\BaseAbstract
    {
        return $this->update;
    }

    /**
     * @param \App\Telegram\Model\Type\Update\BaseAbstract $update
     */
    public function setUpdate(\App\Telegram\Model\Type\Update\BaseAbstract $update)
    {
        $this->update = $update;
    }

    // ########################################

    public function setContainer(\Psr\Container\ContainerInterface $container)
    {
        $this->container = $container;
    }

    // ########################################

    /**
     * @return \App\Entity\Telegram\Bot
     */
    public function getBot(): \App\Entity\Telegram\Bot
    {
        return $this->bot;
    }

    /**
     * @param \App\Entity\Telegram\Bot $bot
     */
    public function setBot(\App\Entity\Telegram\Bot $bot): void
    {
        $this->bot = $bot;
    }

    // ########################################
}
