<?php

namespace CurrencyUaBot\Helpers;

use Predis\Client;
use CurrencyUaBot\Core\App;

trait Cacheable
{
    /**
     * @throws \Exception
     */
    public function cache(): Client
    {
        return App::get('redis');
    }

    /**
     * @param string $source
     * @return string
     * @throws \ReflectionException
     */
    public function getRedisSlug(string $source)
    {
        return $this->getShortName() . '::' . $source;
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function getShortName(): string
    {
        return (new \ReflectionClass($this))->getShortName();
    }
}