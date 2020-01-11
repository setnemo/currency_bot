<?php

namespace CurrencyUaBot\Core;

class Connection
{
    public static function get()
    {
        $dbhost = getenv('DB_HOST');
        $dbname = getenv('DB_NAME');
        $dbcharset = 'UTF-8';
        $dsn = "mysql:host={$dbhost};dbname={$dbname};charset={$dbcharset}";
        $usr = getenv('DB_USERNAME');
        $pwd = getenv('DB_PASSWORD');
        return new \Slim\PDO\Database($dsn, $usr, $pwd);
    }
}