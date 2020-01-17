<?php

namespace CurrencyUaBot\Currency\Api;

use CurrencyUaBot\Helpers\CurrencyConvertable;

class Monobank extends ApiWrapper
{
    use CurrencyConvertable;

    function init()
    {
        $this->setHost('https://api.monobank.ua/');
    }

    /**
     * @inheritDoc
     */
    public function freshCurrency(string $source = 'all'): CurrencyContent
    {
        $key = $this->getCacheSlug($source);
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
                        'test' => 'true'
                    ]
                ]
            )->getBody()->getContents();
            $this->cache()->set($key, $result, 'EX', 300);
        }
        $this->logger()->alert('first ALERT!', []);

        $this->setFresh($this->formatData($result));
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSale(string $currency = null): float
    {
        return $this->getFresh()[$currency]['rateSell'] ?? 1;
    }

    /**
     * @inheritDoc
     */
    public function getBuy(string $currency = null): float
    {
        return $this->getFresh()[$currency]['rateBuy'] ?? 1;
    }

    /**
     * @param string $data
     * @return array
     * @throws \Exception
     */
    protected function formatData(string $data): array
    {
        $array = [];
        $items = \GuzzleHttp\json_decode($data, true);
        foreach ($items as $item) {
            $array[
                strtolower("{$this->getCurrencyAlphabeticCode((int)$item['currencyCodeA'])}")
            ] = $item;
        }

        $this->logger()->alert('ALERT!', $array);
        return $array;
    }
}
