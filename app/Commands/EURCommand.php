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
class EURCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'EUR';
    /**
     * @var string
     */
    protected $description = 'EUR command';
    /**
     * @var string
     */
    protected $usage = '/EUR';
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
        $text    = "
**Курс EUR к UAH**
**Межбанк**
Покупка: {$exchange[Minfin::MB]['eur']['bid']} 
Продажа: {$exchange[Minfin::MB]['eur']['ask']} 

**Средний курс в банках**
Покупка: {$exchange[Minfin::BANKS]['eur']['bid']} 
Продажа: {$exchange[Minfin::BANKS]['eur']['ask']} 

Курс валют предоставлен: [Минфин](https://minfin.com.ua/currency/?utm_source=telegram&utm_medium=EUR2UAH_bot&utm_compaign=eur_post)";
        $data = [
            'chat_id' => $chat_id,
            'text'    => $text,
            'parse_mode' => 'markdown',
            'disable_web_page_preview' => true,
        ];
        return Request::sendMessage($data);
    }
}

/**
 *
 **НБУ**
Покупка: {$exchange[Minfin::NBU]['eur']['bid']}
Продажа: {$exchange[Minfin::NBU]['eur']['ask']}
 */
