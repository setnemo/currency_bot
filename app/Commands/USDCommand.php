<?php

namespace Longman\TelegramBot\Commands\UserCommands;

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
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();
        $exchange = (new Minfin(new Client()))->getCurrencyList();
        $text = $this->getExchangeTextUSD($exchange);
        $data = [
            'chat_id' => $chat_id,
            'text'    => $text,
            'parse_mode' => 'markdown',
            'disable_web_page_preview' => true,
        ];
        return Request::sendMessage($data);
    }

    /**
     * @param array $exchange
     * @return string
     */
    public static function getExchangeTextUSD(array $exchange): string
    {
        return $text = "
**Курс USD к UAH**
**Межбанк**
Покупка: {$exchange[Minfin::MB]['usd']['bid']} 
Продажа: {$exchange[Minfin::MB]['usd']['ask']} 

**НБУ**
Покупка: {$exchange[Minfin::NBU]['usd']['bid']} 
Продажа: {$exchange[Minfin::NBU]['usd']['ask']} 

**Средний курс в банках**
Покупка: {$exchange[Minfin::BANKS]['usd']['bid']} 
Продажа: {$exchange[Minfin::BANKS]['usd']['ask']} 

Курс валют предоставлен: [Минфин](https://minfin.com.ua/currency/?utm_source=telegram&utm_medium=USD2UAH_bot&utm_compaign=usd_post)";
    }
}
