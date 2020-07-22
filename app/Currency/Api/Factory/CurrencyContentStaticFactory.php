<?php

namespace CurrencyUaBot\Currency\Api\Factory;

use CurrencyUaBot\Core\App;
use CurrencyUaBot\Currency\Api\CurrencyContent;
use CurrencyUaBot\Currency\Api\Providers\Minfin;
use CurrencyUaBot\Currency\Api\Providers\Monobank;
use CurrencyUaBot\Currency\Api\Providers\NBU;
use CurrencyUaBot\Currency\Api\Providers\Privatbank;
use CurrencyUaBot\Currency\Api\Providers\PrivatbankOtp24;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use ReflectionException;

final class CurrencyContentStaticFactory
{
    public const MONOBANK = 'Monobank';
    public const NBU = 'NBU';
    public const MINFIN_MB = 'Minfin:megbank';
    public const PRIVAT_CASH = 'Privatbank:cash';
    public const PRIVAT_CARDS = 'Privatbank:cards';
    public const PRIVAT_OTP24 = 'PrivatbankOtp24';

    public const ALLOWED_API = [
        self::MONOBANK,
        self::MINFIN_MB,
        self::NBU,
        self::PRIVAT_CASH,
        self::PRIVAT_CARDS,
        self::PRIVAT_OTP24,
    ];

    /**
     * @param string $type
     * @return CurrencyContent
     * @throws GuzzleException
     * @throws ReflectionException
     * @throws Exception
     */
    public static function factory(string $type): CurrencyContent
    {
        if (!in_array($type, self::ALLOWED_API)) {
            throw new Exception("API $type not allowed");
        }

        $client = self::getClient();

        if ($type === self::MONOBANK) {
            return (new Monobank($client))->freshCurrency();
        } elseif ($type === self::MINFIN_MB) {
            return (new Minfin($client, Minfin::MB))->freshCurrency(Minfin::MB);
        }  elseif ($type === self::PRIVAT_CASH) {
            return (new Privatbank($client, Privatbank::CASH))->freshCurrency(Privatbank::CASH);
        }  elseif ($type === self::PRIVAT_CARDS) {
            return (new Privatbank($client, Privatbank::CARDS))->freshCurrency(Privatbank::CARDS);
        }  elseif ($type === self::PRIVAT_OTP24) {
            return (new PrivatbankOtp24($client))->freshCurrency();
        } elseif ($type === self::NBU) {
            return (new NBU($client))->freshCurrency();
        }
    }

    /**
     * @return Client
     * @throws Exception
     */
    private static function getClient(): Client
    {
        $name = 'guzzle';
        if (!App::exist($name)) {
            $client = new Client();
            App::bind($name, $client);
        } else {
            $client = App::get($name);
        }
        return $client;
    }
}