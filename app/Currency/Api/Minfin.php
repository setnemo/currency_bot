<?php

namespace CurrencyUaBot\Currency\Api;

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

    /**
     * Init Minfin
     */
    function init(): void
    {
        $this->setToken(getenv('EX_TOKEN2'));
        $this->setHost('http://api.minfin.com.ua/');
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
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @inheritDoc
     */
    public function getSale(string $currency = null): float
    {
        $fresh = $this->getFresh();
        if (isset($fresh[$currency]['ask']) && $fresh[$currency]['ask'] > 0 ) {
            return $fresh[$currency]['ask'];
        }

        throw new \Exception("{$currency} not found in {$this->getShortName()}");
    }

    /**
     * @inheritDoc
     */
    public function getBuy(string $currency = null): float
    {
        $fresh = $this->getFresh();
        if (isset($fresh[$currency]['bid']) && $fresh[$currency]['bid'] > 0 ) {
            return $fresh[$currency]['bid'];
        }

        throw new \Exception("{$currency} not found in {$this->getShortName()}");
    }

    /**
     * @inheritDoc
     */
    protected function getRoute(string $source): string
    {
        return $this->host . $this->routes[$source] . $this->token;
    }
}