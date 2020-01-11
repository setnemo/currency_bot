<?php

namespace CurrencyUaBot\Helpers;

use Longman\TelegramBot\Telegram as TgClient;
use Longman\TelegramBot\Exception\TelegramException;

class BotRegistrator
{
    use Logable, Cacheable;

    /**
     * @var TgClient
     */
    private $bot;

    public function __construct(TgClient $bot)
    {
        $this->bot = $bot;
    }

    public function register(string $prefix)
    {
        $key = $prefix . '_registered';
        if(!$this->cache()->exists($key)){
            try {
                $hook_url = "https://". $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
                $result = $this->bot->setWebhook($hook_url);
                if ($result->isOk()) {
                    $this->cache()->set($key, $result->getDescription());
                }
            } catch (TelegramException $e) {
                $this->logger()->error('Registered failed', ['error' => $e->getMessage()]);
            }
        }
    }
}