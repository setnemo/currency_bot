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
     * @param string|null $customClassName
     * @return string
     * @throws \ReflectionException
     */
    public function getCacheSlug(string $source, string $customClassName = null)
    {
        return $this->getShortName($customClassName) . '::' . $source;
    }

    /**
     * @param string|null $name
     * @return string
     * @throws \ReflectionException
     */
    public function getShortName(string $name = null): string
    {
        return $name ? $name : (new \ReflectionClass($this))->getShortName();
    }
}