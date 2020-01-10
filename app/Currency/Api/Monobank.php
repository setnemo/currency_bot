<?php

namespace CurrencyUaBot\Currency\Api;

use CurrencyUaBot\Cache\RedisStorage;

class Monobank extends ApiProvider implements CurrencyApi
{

    function init()
    {
        $this->setHost('https://api.monobank.ua/');
    }

    /**
     * @param string $route
     * @return string
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getContents(string $route = 'mono'): string
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
                $this->host . 'bank/currency',
                [
                    'headers' => [
                        'User-Agent' => 'USD2UAH_bot/1.0 (https://t.me/USD2UAH_bot)',
//                        'test' => 'true'
                    ]
                ]
            )->getBody()->getContents();
            $redis->set($route, $result, 'EX', 300);
        }

        return $result;
    }
}