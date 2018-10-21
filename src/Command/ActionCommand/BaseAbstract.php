<?php
/**
 * Created by PhpStorm.
 * User: Александр
 * Date: 10.09.2018
 * Time: 00:12
 */

namespace App\Command\ActionCommand;

abstract class BaseAbstract
{
    // ########################################

    /**
     * @param \App\Telegram\Model\Type\Update\BaseAbstract $update
     * @param array                                        $params
     *
     * @return string|bool
     */
    abstract public function validate(\App\Telegram\Model\Type\Update\BaseAbstract $update, array $params);

    abstract public function processCommand(\App\Telegram\Model\Type\Update\BaseAbstract $update, \App\Entity\Telegram\User $user, array $params): void;

    // ----------------------------------------

    public function run(
        \App\Telegram\Model\Type\Update\BaseAbstract $update,
        \App\Entity\Telegram\User $user,
        array $params
    ) {
        $trueOrMessage = $this->validate($update, $params);

        if ($trueOrMessage !== true) {
            throw new \Exception('Invalid params to action command');
        }

        $this->processCommand($update, $user, $params);
    }

    // ########################################
}
