<?php

namespace CurrencyUaBot\Helpers;

use CurrencyUaBot\Core\App;

trait Logable
{
    public function logger()
    {
        return App::get('logger');
    }
}