<?php

namespace USD2UAH\Currency;

use GuzzleHttp\Client;
use USD2UAH\Cache\RedisStorage;

class Monobank
{
    /** @var Client */
    private $client;

    /**
     * MinfinApi constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param string $route
     * @return string
     * @throws \Exception
     */
    public function getContents(string $route): string
    {
        $redis = RedisStorage::getInstance();

        if ($redis->exists($route)) {
            $result = $redis->get($route);
        } else {
            $logger = new \Monolog\Logger('monobank');
            $logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__.'/../../logs/mono.log'));
            $logger->info($route);
            $result = $this->client->request(
                'GET',
                'https://api.monobank.ua/bank/currency',
                [
                    'headers' => [
                        'User-Agent' => 'USD2UAH_bot/1.0 (https://t.me/USD2UAH_bot)',
//                        'test' => 'true'
                    ]
                ]
            )->getBody()->getContents();
            $redis->set('monobank', $result, 'EX', 300);
        }

        return $result;
    }


}