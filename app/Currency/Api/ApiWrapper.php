<?php

namespace CurrencyUaBot\Currency\Api;

use CurrencyUaBot\Helpers\Cacheable;
use CurrencyUaBot\Helpers\Logable;
use GuzzleHttp\ClientInterface;

abstract class ApiWrapper
{
    use Cacheable, Logable;


    /** @var string */
    protected $host = '';
    /** @var ClientInterface */
    protected $client;

    /**
     * ApiProvider constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
        $this->init();
    }

    abstract function init();

    /**
     * @param string $host
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }
}