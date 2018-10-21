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
     * @param array $params
     *
     * @return string|bool
     */
    abstract public function validate(array $params);

    abstract public function processCommand(array $params): void;

    // ----------------------------------------

    public function run(array $params)
    {
        $trueOrMessage = $this->validate($params);

        if ($trueOrMessage !== true) {
            throw new \Exception('Invalid params to action command');
        }

        $this->processCommand($params);
    }

    // ########################################
}
