<?php

namespace USD2UAH\Currency;

use GuzzleHttp\Client;
use USD2UAH\Cache\RedisStorage;

class MinfinApi
{
    public const MB = 'megbank';
    public const NBU = 'nbu';
    public const BANKS = 'banks';

    /** @var string */
    protected $host = 'http://api.minfin.com.ua/';

    /** @var array */
    protected $routes = [
        self::MB => 'mb/',
        self::NBU => 'nbu/',
        self::BANKS => 'summary/',
    ];

    /** @var string */
    private $token = '';
    /** @var Client */
    private $client;

    /**
     * MinfinApi constructor.
     */
    public function __construct()
    {
        $this->token = getenv('EX_TOKEN2');
        $this->client = new Client();
    }

    /**
     * @param string $route
     * @return string
     * @throws \Exception
     */
    public function getContents(string $route): string
    {
        $redis = RedisStorage::getInstance();

        if ($redis->exists($route)) {
            $result = $redis->get($route);
        } else {
            $logger = new \Monolog\Logger('minfin');
            $logger->pushHandler(new \Monolog\Handler\StreamHandler(__DIR__.'/../../logs/minfin.log'));
            $logger->info($route);
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
            $redis->set($route, $result, 'EX', 300);
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
     */
    public function getCurrencyMB(): array
    {
        return $this->formatData($this->getContents($this->routes[self::MB]));
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getCurrencyNBU(): array
    {
        return $this->formatData($this->getContents($this->routes[self::NBU]));
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getCurrencyBanks(): array
    {
        return $this->formatData($this->getContents($this->routes[self::BANKS]));
    }
}