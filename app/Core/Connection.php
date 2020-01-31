<?php

namespace CurrencyUaBot\Core;

use Slim\PDO\Database;

class Connection
{
    private static $connection = null;

    private function __construct()
    {
        //
    }

    /**
     * @return Database
     */
    public static function getInstance()
    {
        if (static::$connection === null) {
            $dbhost = getenv('DB_HOST');
            $dbname = getenv('DB_NAME');
            $dsn = "mysql:host={$dbhost};dbname={$dbname};charset=utf8";
            $usr = getenv('DB_USERNAME');
            $pwd = getenv('DB_PASSWORD');
            self::$connection = new Database($dsn, $usr, $pwd);
        }
        return static::$connection;
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