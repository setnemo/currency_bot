<?php

namespace CurrencyUaBot\Helpers;

use Predis\Client;
use CurrencyUaBot\Core\App;

trait Cacheable
{
    /**
     * @throws \Exception
     */
    public function redis(): Client
    {
        return App::get('redis');
    }
}