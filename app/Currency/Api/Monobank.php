<?php

namespace CurrencyUaBot\Currency\Api;

use CurrencyUaBot\Helpers\CurrencyConvertable;

class Monobank extends ApiWrapper
{
    use CurrencyConvertable;

    /**
     * Init Monobank
     */
    protected function init(): void
    {
        $this->setHost('https://api.monobank.ua/');
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
     * @inheritDoc
     */
    protected function getRoute(string $source): string
    {
        return $this->host . 'bank/currency';
    }

    /**
     * @inheritDoc
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

        return $array;
    }
}
