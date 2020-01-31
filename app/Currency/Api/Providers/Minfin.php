<?php

namespace CurrencyUaBot\Currency\Api\Providers;

use CurrencyUaBot\Currency\Api\ApiWrapper;
use Exception;

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
        $this->token = getenv('EX_TOKEN2');
        $this->setHost('http://api.minfin.com.ua/');
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function getSale(string $currency = null): float
    {
        $fresh = $this->getFresh();
        if (isset($fresh[$currency]['ask']) && $fresh[$currency]['ask'] > 0) {
            return $fresh[$currency]['ask'];
        }

        throw new Exception("{$currency} not found in {$this->getShortName()}");
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function getBuy(string $currency = null): float
    {
        $fresh = $this->getFresh();
        if (isset($fresh[$currency]['bid']) && $fresh[$currency]['bid'] > 0) {
            return $fresh[$currency]['bid'];
        }

        throw new Exception("{$currency} not found in {$this->getShortName()}");
    }

    /**
     * @inheritDoc
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
     * @inheritDoc
     */
    protected function getRoute(string $source): string
    {
        return $this->host . $this->routes[$source] . $this->token;
    }
}