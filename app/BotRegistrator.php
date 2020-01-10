<?php

namespace CurrencyUaBot;

use Longman\TelegramBot\Telegram as TgClient;
use Longman\TelegramBot\Exception\TelegramException;
use Monolog\Logger;
use CurrencyUaBot\Cache\RedisStorage;

class BotRegistrator
{
    /**
     * @var TgClient
     */
    private $bot;
    /**
     * @var Logger
     */
    private $logger;

    public function __construct(TgClient $bot, Logger $logger)
    {
        $this->bot = $bot;
        $this->logger = $logger;
    }

    public function register()
    {
        $redis = RedisStorage::getInstance();

        if(!$redis->exists('registered')){
            try {
                $hook_url = "https://". $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
                $result = $this->bot->setWebhook($hook_url);
                if ($result->isOk()) {
                    $redis->set('registered', $result->getDescription());
                }
            } catch (TelegramException $e) {
                $this->logger->error('Registered failed', ['error' => $e->getMessage()]);
            }
        }
    }
}