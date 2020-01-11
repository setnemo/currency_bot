<?php

namespace CurrencyUaBot\Helpers;

use CurrencyUaBot\Core\App;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

trait Logable
{
    /**
     * @return Logger
     * @throws \Exception
     */
    public function logger(): Logger
    {
        return App::get('logger');
    }

    /**
     * @param string $class
     * @return Logger
     * @throws \Exception
     */
    public function requestLogger(string $class): Logger
    {
        $name = $class . '::logger';

        if (App::exist($name)) {
            return App::get($name);
        }

        $logger = new Logger($class);
        $logger->pushHandler(new StreamHandler(App::get('log_path') . $class . '.log'));

        App::bind($name, $logger);

        return $logger;
    }
}