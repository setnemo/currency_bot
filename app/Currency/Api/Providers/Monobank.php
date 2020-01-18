<?php

namespace CurrencyUaBot\Currency\Api\Providers;

use CurrencyUaBot\Currency\Api\ApiWrapper;
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
        $fresh = $this->getFresh();
        if (isset($fresh[$currency]['rateSell']) && $fresh[$currency]['rateSell'] > 0 ) {
            return $fresh[$currency]['rateSell'];
        } elseif (isset($fresh[$currency]['rateCross']) && $fresh[$currency]['rateCross'] > 0) {
            return $fresh[$currency]['rateCross'];
        }

        throw new \Exception("{$currency} not found in {$this->getShortName()}");
    }

    /**
     * @inheritDoc
     */
    public function getBuy(string $currency = null): float
    {
        $fresh = $this->getFresh();
        if (isset($fresh[$currency]['rateBuy']) && $fresh[$currency]['rateBuy'] > 0) {
            return $fresh[$currency]['rateBuy'];
        } elseif (isset($fresh[$currency]['rateCross']) && $fresh[$currency]['rateCross'] > 0) {
            return $fresh[$currency]['rateCross'];
        }

        throw new \Exception("{$currency} not found in {$this->getShortName()}");
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
            // save only UAH to *** exchange, without USD to EUR, etc.
            if ((string)$item['currencyCodeB'] == '980') {
                $array[
                strtolower("{$this->getCurrencyAlphabeticCode((int)$item['currencyCodeA'])}")
                ] = $item;
            }
        }

        return $array;
    }
}
