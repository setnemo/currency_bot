<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use CurrencyUaBot\Currency\Api\Providers\Minfin;
use GuzzleHttp\Client;
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
class RUBCommand extends UserCommand
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
    protected $usage = 'RUB';
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
     * @throws TelegramException
     * @throws ReflectionException
     */
    public function execute()
    {
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();
        $exchange = (new Minfin(new Client()))->getCurrencyList();
        $text = "
**Курс RUB к UAH**
**Межбанк**
Покупка: {$exchange[Minfin::MB]['rub']['bid']} 
Продажа: {$exchange[Minfin::MB]['rub']['ask']} 

**Средний курс в банках**
Покупка: {$exchange[Minfin::BANKS]['rub']['bid']} 
Продажа: {$exchange[Minfin::BANKS]['rub']['ask']} 

Курс валют предоставлен: [Минфин](https://minfin.com.ua/currency/?utm_source=telegram&utm_medium=USD2UAH_bot&utm_compaign=rub_post)";
        $data = [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => 'markdown',
            'disable_web_page_preview' => true,
        ];
        return Request::sendMessage($data);
    }

    /**
     *
     **НБУ**
     * Покупка: {$exchange[Minfin::NBU]['rub']['bid']}
     * Продажа: {$exchange[Minfin::NBU]['rub']['ask']}
     */
}
