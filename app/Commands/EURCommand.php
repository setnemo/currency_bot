<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;
use USD2UAH\Currency\MinfinApi;

/**
 * Start command
 *
 * Gets executed when a user first starts using the bot.
 */
class EURCommand extends SystemCommand
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
        $exchange = (new MinfinApi())->getCurrencyList();
        $text    = "
**Курс EUR к UAH**
**Межбанк**
Покупка: {$exchange[MinfinApi::MB]['eur']['bid']} 
Продажа: {$exchange[MinfinApi::MB]['eur']['ask']} 

**НБУ**
Покупка: {$exchange[MinfinApi::NBU]['eur']['bid']} 
Продажа: {$exchange[MinfinApi::NBU]['eur']['ask']} 

**Средний курс в банках**
Покупка: {$exchange[MinfinApi::BANKS]['eur']['bid']} 
Продажа: {$exchange[MinfinApi::BANKS]['eur']['ask']} 

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
