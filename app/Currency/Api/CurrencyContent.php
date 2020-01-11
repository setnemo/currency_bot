<?php

namespace CurrencyUaBot\Currency\Api;


interface CurrencyContent
{
    public function getContents(string $route): string;

}