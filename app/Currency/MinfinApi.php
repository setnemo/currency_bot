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
//                        'test' => 'true'
                    ]
                ]
            )->getBody()->getContents();
            $redis->set($route, $result, 'EX', 300);
        }

        return $result;
    }

    public function getCurrencyList(): array
    {
        $mb = $this->getContents($this->routes[self::MB]);
        $nbu = $this->getContents($this->routes[self::NBU]);
        $banks = $this->getContents($this->routes[self::BANKS]);

        return $this->contentConverter($mb, $nbu, $banks);
    }

    /**
     * @param string $mb
     * @param string $nbu
     * @param string $banks
     * @return array
     */
    protected function contentConverter(string $mb, string $nbu, string $banks): array
    {
        return [
            self::BANKS => $this->formatData($banks),
            self::NBU => $this->formatData($nbu),
            self::MB => $this->formatData($mb),
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
}