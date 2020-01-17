<?php

namespace CurrencyUaBot\Currency\Api;

use CurrencyUaBot\Currency\CurrencyEntity;
use CurrencyUaBot\Helpers\Cacheable;
use CurrencyUaBot\Helpers\Logable;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

abstract class ApiWrapper implements CurrencyContent
{
    use Cacheable, Logable;

    /** @var string */
    protected $host = '';
    /** @var ClientInterface */
    protected $client;
    /** @var array */
    protected $fresh = [];

    /**
     * Init class
     */
    abstract protected function init(): void;

    /**
     * Get route for necessary endpoint
     *
     * @param string $source
     * @return string
     */
    abstract protected function getRoute(string $source): string;

    /**
     * Formatting api response
     *
     * @param string $data
     * @return array
     */
    abstract protected function formatData(string $data): array;

    /**
     * ApiWrapper constructor
     *
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
        $this->init();
    }

    /**
     * @param string $host
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    /**
     * @inheritDoc
     */
    public function freshCurrency(string $source = 'all'): CurrencyContent
    {
        $route = $this->getRoute($source);
        $key = $this->getCacheSlug($source);
        $result = $this->getContent($key, $route);
        $this->setFresh($this->formatData($result));
        return $this;
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function getCurrency(string $currency = null): CurrencyEntity
    {
        $name = $this->getShortName();
        if (!$currency) {
            $this->logger()->warning("$name try get currency without require param");
            throw new \Exception("$name try get currency without require param");
        }

        return new CurrencyEntity($name, $currency, $this->getSale($currency), $this->getBuy($currency));
    }

    /**
     * @inheritDoc
     * @throws \Exception
     * @throws GuzzleException
     */
    public function getContent(string $key, string $route, string $method = 'GET'): string
    {
        if ($this->cache()->exists($key)) {
            $result = $this->cache()->get($key);
        } else {
            $logger = $this->requestLogger($this->getShortName());
            $logger->info($key);
            $result = $this->client->request(
                $method,
                $route,
                [
                    'headers' => [
                        'User-Agent' => 'USD2UAH_bot/1.0 (https://t.me/USD2UAH_bot)',
                        'test' => 'true'
                    ]
                ]
            )->getBody()->getContents();
            $this->cache()->set($key, $result, 'EX', 300);
        }
        return $result;
    }

    /**
     * @param array $fresh
     */
    protected function setFresh(array $fresh): void
    {
        $this->fresh = $fresh;
    }

    /**
     * @return array
     */
    protected function getFresh(): array
    {
        return $this->fresh;
    }
}