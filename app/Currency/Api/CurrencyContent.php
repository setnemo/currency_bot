<?php

namespace CurrencyUaBot\Currency\Api;

use CurrencyUaBot\Currency\CurrencyEntity;

interface CurrencyContent
{
    public function getContents(string $route): string;

//    public function getCurrency(string $currency = null): CurrencyEntity;

}