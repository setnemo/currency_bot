<?php

namespace CurrencyUaBot\Core;

use Dotenv\Dotenv;
use Exception;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\TelegramLog;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class App
{
    protected static $registry = [];

    /**
     * @param string $projectPath
     */
    public static function run(string $projectPath): void
    {
        /**
         * Init Core
         */
        $env = Dotenv::createImmutable($projectPath);
        $env->load();
        $token = getenv('TG_TOKEN');
        $botName = getenv('TG_BOT_NAME');
        App::bind('log_path', $projectPath . '/logs/');
        $logger = new Logger('app');
        try {
            $logger->pushHandler(new StreamHandler(App::get('log_path') . 'app.log', Logger::ERROR));
            $logger->pushHandler(new StreamHandler(App::get('log_path') . 'debug.log', Logger::DEBUG));
        } catch (Exception $e) {
            $logger->error($e->getMessage());
            return;
        }
        App::bind('logger', $logger);
        App::bind('db', Connection::getInstance());
        App::bind('redis', RedisStorage::getInstance());

        /**
         * Init Telegram
         */
        try {
            $tg = (new TelegramWrapper($projectPath, $token, $botName, $logger))->init();
            App::bind('tg', $tg);
        } catch (TelegramException $e) {
            // Log telegram errors
            TelegramLog::error($e);
        } catch (Exception $exception) {
            $logger->error($exception->getMessage());
        } catch (\Throwable $t) {
            $logger->error($t->getMessage());
        }
    }

    /**
     * @param string $key
     * @param $value
     */
    public static function bind(string $key, $value): void
    {
        static::$registry[$key] = $value;
    }

    /**
     * @param string $key
     * @return mixed
     * @throws Exception
     */
    public static function get(string $key)
    {
        if (!self::exist($key)) {
            throw new Exception('No {$key} is bound in the container.');
        }

        return static::$registry[$key];
    }

    /**
     * @param string $key
     * @return bool
     */
    public static function exist(string $key): bool
    {
        return array_key_exists($key, static::$registry);
    }
}