<?php

namespace CurrencyUaBot\Currency\Api\Providers;

use CurrencyUaBot\Currency\Api\ApiWrapper;
use CurrencyUaBot\Traits\CurrencyConvertable;
use Exception;

class NBU extends ApiWrapper
{
    use CurrencyConvertable;

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function getSale(string $currency = null): float
    {
        $fresh = $this->getFresh();
        if (isset($fresh[$currency]['rate']) && $fresh[$currency]['rate'] > 0) {
            return $fresh[$currency]['rate'];
        }

        throw new Exception("{$currency} not found in {$this->getShortName()}");
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function getBuy(string $currency = null): float
    {
        return $this->getSale($currency);
    }

    /**
     * Init Monobank
     */
    protected function init(): void
    {
        $this->setHost('https://bank.gov.ua/');
    }

    /**
     * @inheritDoc
     */
    protected function getRoute(string $source): string
    {
        return $this->host . 'NBUStatService/v1/statdirectory/exchange?json';
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    protected function formatData(string $data): array
    {
        $array = [];
        $items = json_decode($data, true);

        foreach ($items as $item) {
            $array[strtolower($item['cc'])] = $item;
        }

        return $array;
    }
}
