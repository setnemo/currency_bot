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
class RUBCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'RUB';
    /**
     * @var string
     */
    protected $description = 'RUB command';
    /**
     * @var string
     */
    protected $usage = '/RUB';
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
**Курс RUB к UAH**
**Межбанк**
Покупка: {$exchange[MinfinApi::MB]['rub']['bid']} 
Продажа: {$exchange[MinfinApi::MB]['rub']['ask']} 

**НБУ**
Покупка: {$exchange[MinfinApi::NBU]['rub']['bid']} 
Продажа: {$exchange[MinfinApi::NBU]['rub']['ask']} 

**Средний курс в банках**
Покупка: {$exchange[MinfinApi::BANKS]['rub']['bid']} 
Продажа: {$exchange[MinfinApi::BANKS]['rub']['ask']} 

Курс валют предоставлен: [Минфин](https://minfin.com.ua/currency/?utm_source=telegram&utm_medium=USD2UAH_bot&utm_compaign=rub_post)";
        $data = [
            'chat_id' => $chat_id,
            'text'    => $text,
            'parse_mode' => 'markdown',
            'disable_web_page_preview' => true,
        ];
        return Request::sendMessage($data);
    }
}
