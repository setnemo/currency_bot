<?php

namespace CurrencyUaBot\Core;

use Slim\PDO\Database;
use CurrencyUaBot\Core\DbRepository;

class Connection
{
    private static $connection = null;
    private static $repository = null;

    private function __construct()
    {
        //
    }

    /**
     * @return Database
     */
    public static function getInstance(): Database
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

    public static function getRepository(): DbRepository
    {
        if (static::$repository === null) {
            return new DbRepository(static::getInstance());
        }
        return static::$repository;
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