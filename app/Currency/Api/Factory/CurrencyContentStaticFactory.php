<?php

namespace CurrencyUaBot\Currency\Api\Factory;

use CurrencyUaBot\Core\App;
use CurrencyUaBot\Currency\Api\CurrencyContent;
use CurrencyUaBot\Currency\Api\Providers\Minfin;
use CurrencyUaBot\Currency\Api\Providers\Monobank;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use ReflectionException;

final class CurrencyContentStaticFactory
{
    public const MONOBANK = 'Monobank';
    public const MINFIN_MB = 'Minfin_megbank';

    public const ALLOWED_API = [
        self::MONOBANK,
        self::MINFIN_MB,
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