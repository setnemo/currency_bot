<?php

namespace CurrencyUaBot\Core;

class Connection
{
    public static function get()
    {
        $dbhost = getenv('DB_HOST');
        $dbname = getenv('DB_NAME');
        $dsn = "mysql:host={$dbhost};dbname={$dbname};charset=utf8";
        $usr = getenv('DB_USERNAME');
        $pwd = getenv('DB_PASSWORD');
        return new \Slim\PDO\Database($dsn, $usr, $pwd);
    }
}