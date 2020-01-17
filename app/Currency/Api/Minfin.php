<?php

namespace CurrencyUaBot\Currency\Api;

use GuzzleHttp\Exception\GuzzleException;

class Minfin extends ApiWrapper
{
    public const MB = 'megbank';
    public const NBU = 'nbu';
    public const BANKS = 'banks';

    protected $token = '';

    /** @var array */
    protected $routes = [
        self::MB => 'mb/',
        self::NBU => 'nbu/',
        self::BANKS => 'summary/',
    ];

    function init()
    {
        $this->setToken(getenv('EX_TOKEN2'));
        $this->setHost('http://api.minfin.com.ua/');
    }

    /**
     * @param string $source
     * @return CurrencyContent
     * @throws GuzzleException
     * @throws \ReflectionException
     */
    public function freshCurrency(string $source): CurrencyContent
    {
        $route = $this->routes[$source];
        $key = $this->getCacheSlug($source);
        if ($this->cache()->exists($key)) {
            $result = $this->cache()->get($key);
        } else {
            $logger = $this->requestLogger($this->getShortName());
            $logger->info($key);
            $result = $this->client->request(
                'GET',
                $this->host . $route . $this->token,
                [
                    'headers' => [
                        'User-Agent' => 'USD2UAH_bot/1.0 (https://t.me/USD2UAH_bot)',
                        'test' => 'true'
                    ]
                ]
            )->getBody()->getContents();
            $this->cache()->set($key, $result, 'EX', 300);
        }

        $this->setFresh($this->formatData($result));
        return $this;
    }


    /**
     * @param string $data
     * @return array
     */
    protected function formatData(string $data): array
    {
        $array = [];
        $items = array_reverse(\GuzzleHttp\json_decode($data, true));

        foreach ($items as $key => $item) {
            $array[$item['currency'] ?? $key] = $item;
        }

        return array_reverse($array);
    }

    /**
     * @param string $token
     * @return Minfin
     */
    public function setToken(string $token): Minfin
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSale(string $currency = null): float
    {
        return $this->getFresh()[$currency]['ask'] ?? 1;
    }

    /**
     * @inheritDoc
     */
    public function getBuy(string $currency = null): float
    {
        return $this->getFresh()[$currency]['bid'] ?? 1;
    }

}