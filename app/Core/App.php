<?php

namespace CurrencyUaBot\Core;

class App
{
    protected static $registry = [];

    /**
     * @param string $key
     * @param $value
     */
    public static function bind(string $key, $value)
    {
        static::$registry[$key] = $value;
    }

    /**
     * @param string $key
     * @return mixed
     * @throws \Exception
     */
    public static function get(string $key)
    {
        if (!array_key_exists($key, static::$registry)) {
            throw new \Exception('No {$key} is bound in the container.');
        }

        return static::$registry[$key];
    }
}