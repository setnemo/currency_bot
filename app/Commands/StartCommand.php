<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;

/**
 * Start command
 *
 * Gets executed when a user first starts using the bot.
 */
class StartCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'start';
    /**
     * @var string
     */
    protected $description = 'Start command';
    /**
     * @var string
     */
    protected $usage = '/start';
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
        $text    = "
Привет! Я умею показывать курс валют НБУ, межбанка, средний курс в банках. Информацию я беру на сайте [Минфин](https://minfin.com.ua/currency/?utm_source=telegram&utm_medium=USD2UAH_bot&utm_compaign=welcome_post).

Также я умею конвертировать доллар в гривну и наоборот в режиме *инлайн*. Просто напиши `@USD2UAH_bot 1000` в любом чате, и я сконвертирую эту сумму по текущему курсу! Для этого даже не нужно открывать чат со мной.

В диалоге со мной можно узнать курсы валют \"командой\" валюты, это /usd /eur /rub

Если у тебя будут проблемы с моей работой - пиши моему создателю, его контакты есть в описании.
";
        $data = [
            'chat_id' => $chat_id,
            'text'    => $text,
            'parse_mode' => 'markdown',
            'disable_web_page_preview' => true,
        ];
        return Request::sendMessage($data);
    }
}
