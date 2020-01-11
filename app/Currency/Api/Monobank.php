<?php

namespace CurrencyUaBot\Currency\Api;

class Monobank extends ApiWrapper implements CurrencyContent
{

    function init()
    {
        $this->setHost('https://api.monobank.ua/');
    }

    /**
     * @param string $source
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \ReflectionException
     */
    public function getContents(string $source = 'all'): string
    {
        $key = $this->getRedisSlug($source);
        if ($this->cache()->exists($key)) {
            $result = $this->cache()->get($key);
        } else {
            $logger = $this->requestLogger($this->getShortName());
            $logger->info($key);
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
            $this->cache()->set($key, $result, 'EX', 300);
        }

        return $result;
    }
}