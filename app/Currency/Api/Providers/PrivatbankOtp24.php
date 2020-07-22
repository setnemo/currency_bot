<?php

namespace CurrencyUaBot\Currency\Api\Providers;

use CurrencyUaBot\Currency\Api\ApiWrapper;
use CurrencyUaBot\Traits\CurrencyConvertable;
use Exception;

class PrivatbankOtp24 extends ApiWrapper
{
    use CurrencyConvertable;

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function getSale(string $currency = null): float
    {
        $fresh = $this->getFresh();
        if (isset($fresh[$currency]['S']['rate']) && $fresh[$currency]['S']['rate'] > 0) {
            return $fresh[$currency]['S']['rate'];
        }

        throw new Exception("{$currency} not found in {$this->getShortName()}");
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function getBuy(string $currency = null): float
    {
        $fresh = $this->getFresh();
        if (isset($fresh[$currency]['B']['rate']) && $fresh[$currency]['B']['rate'] > 0) {
            return $fresh[$currency]['B']['rate'];
        }

        throw new Exception("{$currency} not found in {$this->getShortName()}");
    }

    /**
     * Init Monobank
     */
    protected function init(): void
    {
        $this->setHost('https://otp24.privatbank.ua/');
    }

    /**
     * @inheritDoc
     */
    protected function getRoute(string $source): string
    {
        return $this->host . 'api/1/info/currency/get';
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    protected function formatData(string $data): array
    {
        $array = [];
        $items = json_decode($data, true);
        if (isset($items['cache_info'])) {
            $items['cache_info'] = null;
            $items = array_filter($items);
        }
        foreach ($items as $currency => $item) {

            $array[strtolower($currency)] = $item;
        }

        return $array;
    }
}
