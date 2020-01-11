<?php

namespace CurrencyUaBot\Currency\Api;

use GuzzleHttp\Exception\GuzzleException;

class Minfin extends ApiWrapper implements CurrencyContent
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
     * @return string
     * @throws GuzzleException
     * @throws \ReflectionException
     */
    public function getContents(string $source): string
    {
        $route = $this->routes[$source];
        $key = $this->getRedisSlug($source);
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

        return $result;
    }

    public function getCurrencyList(): array
    {
        return [
            self::BANKS => $this->getCurrencyBanks(),
            self::NBU => $this->getCurrencyNBU(),
            self::MB => $this->getCurrencyMB(),
        ];
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
     * @return array
     * @throws \Exception
     * @throws GuzzleException
     */
    public function getCurrencyMB(): array
    {
        return $this->formatData($this->getContents(self::MB));
    }

    /**
     * @return array
     * @throws \Exception
     * @throws GuzzleException
     */
    public function getCurrencyNBU(): array
    {
        return $this->formatData($this->getContents(self::NBU));
    }

    /**
     * @return array
     * @throws \Exception
     * @throws GuzzleException
     */
    public function getCurrencyBanks(): array
    {
        return $this->formatData($this->getContents(self::BANKS));
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

}