<?php

namespace CurrencyUaBot\Currency\Api\Providers;

use CurrencyUaBot\Core\App;
use CurrencyUaBot\Currency\Api\ApiWrapper;
use CurrencyUaBot\Traits\CurrencyConvertable;
use Exception;

class Privatbank extends ApiWrapper
{
    use CurrencyConvertable;

    public const CASH = 'cash';
    public const CARDS = 'cards';

    /** @var array */
    protected $routes = [
        self::CASH => 'p24api/pubinfo?json&exchange&coursid=5',
        self::CARDS => 'p24api/pubinfo?exchange&json&coursid=11',
    ];

    /**
     * Init Minfin
     */
    function init(): void
    {
        $this->setHost('https://api.privatbank.ua/');
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function getSale(string $currency = null): float
    {
        $fresh = $this->getFresh();
        if (isset($fresh[$currency]['sale']) && floatval($fresh[$currency]['sale']) > 0) {
            return floatval($fresh[$currency]['sale']);
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
        if (isset($fresh[$currency]['buy']) && floatval($fresh[$currency]['buy']) > 0) {
            return floatval($fresh[$currency]['buy']);
        }

        throw new Exception("{$currency} not found in {$this->getShortName()}");
    }

    /**
     * @inheritDoc
     */
    protected function formatData(string $data): array
    {
        $array = [];
        $items = json_decode($data, true);

        foreach ($items as $item) {
            // save only UAH to *** exchange, without USD to BTC, etc.
            // @TODO use all currency pairs
            if ($item['base_ccy'] == 'UAH') {
                $array[strtolower($item['ccy'])] = $item;
            }
        }

        return $array;
    }

    /**
     * @inheritDoc
     */
    protected function getRoute(string $source): string
    {
        return $this->host . $this->routes[$source];
    }
}


/**
 * ["
 * [
 *    [usd] =>
 *        [
 *            [ccy] => USD
 *            [base_ccy] => UAH
 *            [buy] => 24.34000
 *            [sale] => 24.63054
 *        )
 *
 *    [eur] =>
 *        [
 *            [ccy] => EUR
 *            [base_ccy] => UAH
 *            [buy] => 26.29000
 *            [sale] => 26.73797
 *        )
 *
 *    [rur] =>
 *        [
 *            [ccy] => RUR
 *            [base_ccy] => UAH
 *            [buy] => 0.35200
 *            [sale] => 0.38701\n        )
 *
 * )
 * "]
 */