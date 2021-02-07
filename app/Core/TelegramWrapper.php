<?php

namespace CurrencyUaBot\Core;

use CurrencyUaBot\Traits\Cacheable;
use CurrencyUaBot\Traits\Logable;
use Exception;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\TelegramLog;
use Monolog\Logger;

class TelegramWrapper
{
    use Logable, Cacheable;
    /** @var string */
    protected $projectPath = '';
    /** @var string */
    protected $token = '';
    /** @var string */
    protected $botName = '';
    /** @var Logger */
    protected $logger;
    /** @var Telegram */
    private $bot;

    /**
     * TelegramWrapper constructor.
     * @param string $projectPath
     * @param string $token
     * @param string $botName
     * @param Logger $logger
     */
    public function __construct(string $projectPath, string $token, string $botName, Logger $logger)
    {
        $this->projectPath = $projectPath;
        $this->token = $token;
        $this->botName = $botName;
        $this->logger = $logger;
    }

    /**
     * @throws TelegramException
     * @throws Exception
     */
    public function init(): self
    {
        $this->bot = new Telegram($this->token, $this->botName);
        $this->register($this->botName);
        TelegramLog::initialize($this->logger);
        $this->bot->enableAdmin(intval(getenv('ADMIN')));
        $this->bot->addCommandsPaths([
            $this->projectPath . '/app/Commands/',
        ]);

        $this->bot->enableExternalMySql(App::get('db'));
//        $this->bot->enableLimiter();
        return $this;
    }
    
    public function run()
    {
        $this->bot->handle();
    }
    /**
     * @param string $prefix
     * @throws Exception
     */
    private function register(string $prefix): void
    {
        $key = $prefix . '_registered';
        if (!$this->cache()->exists($key)) {
            try {
                $hook_url = "https://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
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