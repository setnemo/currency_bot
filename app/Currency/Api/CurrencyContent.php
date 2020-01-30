<?php

namespace CurrencyUaBot\Currency\Api;

use CurrencyUaBot\Currency\CurrencyEntity;

interface CurrencyContent
{
    /**
     * @param string $key
     * @param string $route
     * @param string $method
     * @return string
     */
    public function getContent(string $key, string $route, string $method = 'GET'): string;

    /**
     * @param string $source
     * @return CurrencyContent
     */
    public function freshCurrency(string $source): CurrencyContent;

    /**
     * @param string|null $currency
     * @return CurrencyEntity
     */
    public function getCurrency(string $currency = null): CurrencyEntity;

    /**
     * @param string|null $currency
     * @return float
     */
    public function getSale(string $currency = null): float;

    /**
     * @param string|null $currency
     * @return float
     */
    public function getBuy(string $currency = null): float;

    /**
     * @return string
     */
    public function getSourceName(): string;

}