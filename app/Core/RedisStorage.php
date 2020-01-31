<?php

namespace CurrencyUaBot\Core;

use Predis\Client;

class RedisStorage
{
    private static $redis = null;

    private function __construct()
    {
        //
    }

    /**
     * @return Client
     */
    public static function getInstance()
    {
        if (static::$redis === null) {
            self::$redis = new Client();
        }
        return static::$redis;
    }

    private function __clone()
    {
        //
    }

    private function __wakeup()
    {
        //
    }
}