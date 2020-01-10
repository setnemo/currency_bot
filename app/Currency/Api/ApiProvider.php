<?php

namespace CurrencyUaBot\Currency\Api;

use GuzzleHttp\ClientInterface;

abstract class ApiProvider
{
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