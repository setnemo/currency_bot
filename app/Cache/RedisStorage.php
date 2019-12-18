<?php

namespace USD2UAH\Cache;

use Predis\Client;

class RedisStorage
{
    private static $redis = null;

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

    private function __construct()
    {
        //
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