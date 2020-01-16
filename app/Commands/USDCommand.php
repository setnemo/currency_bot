<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use CurrencyUaBot\Currency\CurrencyEntity;
use GuzzleHttp\Client;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;
use CurrencyUaBot\Currency\Api\Minfin;

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
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Longman\TelegramBot\Exception\TelegramException
     * @throws \ReflectionException
     */
    public function execute()
    {
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();
        $entityMB = (new Minfin(new Client()))->freshCurrency(Minfin::MB)->getCurrency('usd');
        $entityBanks = (new Minfin(new Client()))->freshCurrency(Minfin::BANKS)->getCurrency('usd');
        $entityNBU = (new Minfin(new Client()))->freshCurrency(Minfin::NBU)->getCurrency('usd');

        $text = $this->getExchangeTextUSDe($entityMB, $entityBanks, $entityNBU);
        $data = [
            'chat_id' => $chat_id,
            'text'    => $text,
            'parse_mode' => 'markdown',
            'disable_web_page_preview' => true,
        ];
        return Request::sendMessage($data);
    }

    public static function getExchangeTextUSDe(
        CurrencyEntity $entityMB,
        CurrencyEntity $entityBanks,
        CurrencyEntity $entityNBU
    ): string {
        return $text = "
**Курс USD к UAH**
**Межбанк**
Покупка: {$entityMB->getSale()} 
Продажа: {$entityMB->getBuy()} 

**Средний курс в банках**
Покупка: {$entityBanks->getSale()} 
Продажа: {$entityBanks->getBuy()}

**НБУ**
Покупка: {$entityNBU->getSale()} 
Продажа: {$entityNBU->getBuy()} 

Курс валют предоставлен: [Минфин](https://minfin.com.ua/currency/?utm_source=telegram&utm_medium=USD2UAH_bot&utm_compaign=usd_post)";
    }
}
