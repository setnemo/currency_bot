<?php

namespace CurrencyUaBot\Currency\Api;

use CurrencyUaBot\Currency\CurrencyEntity;
use CurrencyUaBot\Helpers\Cacheable;
use CurrencyUaBot\Helpers\Logable;
use GuzzleHttp\ClientInterface;

abstract class ApiWrapper implements CurrencyContent
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

    public function getCurrency(string $currency = null): CurrencyEntity
    {
        $name = $this->getShortName();
        if (!$currency) {
            $this->logger()->warning("$name try get currency without require param");
            throw new \Exception("$name try get currency without require param");
        }

        return new CurrencyEntity($name, $currency, $this->getSale($currency), $this->getBuy($currency));
    }
}