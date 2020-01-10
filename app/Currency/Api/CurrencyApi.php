<?php

namespace CurrencyUaBot\Currency\Api;


interface CurrencyApi
{
    public function getContents(string $route ): string;

}