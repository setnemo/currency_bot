<?php

namespace USD2UAH;

use Longman\TelegramBot\Telegram as TgClient;
use Longman\TelegramBot\Exception\TelegramException;
use Monolog\Logger;
use Predis\Client as RedisClient;

class BotRegistrator
{
    /**
     * @var RedisClient
     */
    private $redis;

    /**
     * @var TgClient
     */
    private $bot;
    /**
     * @var Logger
     */
    private $logger;

    public function __construct(TgClient $bot, RedisClient $redis,  Logger $logger)
    {
        $this->redis = $redis;
        $this->bot = $bot;
        $this->logger = $logger;
    }

    public function register()
    {
        if(!$this->redis->exists('registered')){
            try {
                $hook_url = "https://". $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
                $result = $this->bot->setWebhook($hook_url);
                if ($result->isOk()) {
                    $this->redis->set('registered', $result->getDescription());
                }
            } catch (TelegramException $e) {
                $this->logger->error('Registered failed', ['error' => $e->getMessage()]);
            }
        }
    }
}