<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use CurrencyUaBot\Currency\Api\Factory\CurrencyContentStaticFactory;
use CurrencyUaBot\Currency\Api\Providers\Minfin;
use CurrencyUaBot\Currency\CurrencyEntity;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use ReflectionException;

/**
 * Start command
 *
 * Gets executed when a user first starts using the bot.
 */
class USDCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'USD';
    /**
     * @var string
     */
    protected $description = 'USD command';
    /**
     * @var string
     */
    protected $usage = '/USD';
    /**
     * @var string
     */
    protected $version = '1.1.0';
    /**
     * @var bool
     */
    protected $private_only = true;

    /**
     * Command execute method
     *
     * @return ServerResponse
     * @throws GuzzleException
     * @throws TelegramException
     * @throws ReflectionException
     */
    public function execute()
    {
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();
        $entityMB = (CurrencyContentStaticFactory::factory(CurrencyContentStaticFactory::MINFIN_MB))->getCurrency('usd');
//        $entityMB = CurrencyContentStaticFactory::factory(CurrencyContentStaticFactory::MINFIN_BANKS);
//        $entityBanks = (new Minfin(new Client()))->freshCurrency(Minfin::)->getCurrency('usd');

        $text = $this->getExchangeTextUSDe($entityMB);
        $data = [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => 'markdown',
            'disable_web_page_preview' => true,
        ];
        return Request::sendMessage($data);
    }

    public static function getExchangeTextUSDe(
        CurrencyEntity $entityMB): string
    {
        return $text = "
**Курс USD к UAH**
**Межбанк**
Покупка: {$entityMB->getSale()} 
Продажа: {$entityMB->getBuy()} 


Курс валют предоставлен: [Минфин](https://minfin.com.ua/currency/?utm_source=telegram&utm_medium=USD2UAH_bot&utm_compaign=usd_post)";
    }
}
