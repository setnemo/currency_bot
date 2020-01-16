<?php

namespace CurrencyUaBot\Currency\Api;

use CurrencyUaBot\Currency\CurrencyEntity;

class Monobank extends ApiWrapper
{

    function init()
    {
        $this->setHost('https://api.monobank.ua/');
    }

//    /**
//     * @param string $source
//     * @return string
//     * @throws \GuzzleHttp\Exception\GuzzleException
//     * @throws \ReflectionException
//     */
//    public function getContents(string $source = 'all'): string
//    {
//        $key = $this->getCacheSlug($source);
//        if ($this->cache()->exists($key)) {
//            $result = $this->cache()->get($key);
//        } else {
//            $logger = $this->requestLogger($this->getShortName());
//            $logger->info($key);
//            $result = $this->client->request(
//                'GET',
//                $this->host . 'bank/currency',
//                [
//                    'headers' => [
//                        'User-Agent' => 'USD2UAH_bot/1.0 (https://t.me/USD2UAH_bot)',
////                        'test' => 'true'
//                    ]
//                ]
//            )->getBody()->getContents();
//            $this->cache()->set($key, $result, 'EX', 300);
//        }
//
//        return $result;
//    }
    /**
     * @inheritDoc
     */
    public function freshCurrency(string $source): CurrencyContent
    {
        // TODO: Implement freshCurrency() method.
    }

    /**
     * @inheritDoc
     */
    public function getSale(string $currency = null): float
    {
        // TODO: Implement getSale() method.
    }

    /**
     * @inheritDoc
     */
    public function getBuy(string $currency = null): float
    {
        // TODO: Implement getBuy() method.
    }
}