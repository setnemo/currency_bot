<?php

namespace CurrencyUaBot\Currency\Api;

use CurrencyUaBot\Core\App;
use CurrencyUaBot\Currency\CurrencyEntity;
use CurrencyUaBot\Traits\Cacheable;
use CurrencyUaBot\Traits\Logable;
use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use ReflectionException;

abstract class ApiWrapper implements CurrencyContent
{
    use Cacheable, Logable;

    /** @var string */
    protected $host = '';
    /** @var ClientInterface */
    protected $client;
    /** @var array */
    protected $fresh = [];
    /** @var string */
    protected $sourceName = '';
    /** @var int */
    protected $TTL = 300;

    /**
     * ApiWrapper constructor
     *
     * @param ClientInterface $client
     * @param string|null $sourceName
     * @throws ReflectionException
     */
    public function __construct(ClientInterface $client, string $sourceName = null)
    {
        $detailsName = $sourceName ? ":$sourceName" : '';
        $this->client = $client;
        $this->sourceName = $this->getShortName() . $detailsName;
        $this->init();
    }

    /**
     * Init class
     */
    abstract protected function init(): void;

    /**
     * @param string $host
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    /**
     * @inheritDoc
     * @throws ReflectionException
     * @throws GuzzleException
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
     * Get route for required api endpoint
     *
     * @param string $source
     * @return string
     */
    abstract protected function getRoute(string $source): string;

    /**
     * @inheritDoc
     * @throws Exception
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
            $this->cache()->set($key, $result, 'EX', $this->TTL);
        }
        return $result;
    }

    /**
     * Formatting api response
     *
     * @param string $data
     * @return array
     */
    abstract protected function formatData(string $data): array;

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function getCurrency(string $currency = null): CurrencyEntity
    {
        $name = $this->getShortName();
        if (!$currency) {
            $this->logger()->warning("$name try get currency without require param");
            throw new Exception("$name try get currency without require param");
        }

        return new CurrencyEntity($this->getSourceName(), $currency, $this->getSale($currency), $this->getBuy($currency));
    }

    /**
     * @inheritDoc
     */
    public function getSourceName(): string
    {
        return $this->sourceName;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return $this->getFresh();
    }

    /**
     * @return array
     */
    protected function getFresh(): array
    {
        return $this->fresh;
    }

    /**
     * @param array $fresh
     */
    protected function setFresh(array $fresh): void
    {
        $this->fresh = $fresh;
    }
}