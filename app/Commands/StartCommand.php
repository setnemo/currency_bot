<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use CurrencyUaBot\Core\App;
use CurrencyUaBot\Core\Connection;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\DB;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Entities\User;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Slim\PDO\Database;

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
     * @return ServerResponse
     * @throws TelegramException
     */
    public function execute()
    {
//        $text = "
//Привет! Я умею показывать курс валют НБУ, межбанка, средний курс в банках. Информацию я беру на сайте [Минфин](https://minfin.com.ua/currency/?utm_source=telegram&utm_medium=USD2UAH_bot&utm_compaign=welcome_post).
//
//Также я умею конвертировать доллар в гривну и наоборот в режиме *инлайн*. Просто напиши `@USD2UAH_bot 1000` в любом чате, и я сконвертирую эту сумму по текущему курсу! Для этого даже не нужно открывать чат со мной. Кроме этого можно указать валюту, например `@USD2UAH_bot eur 1000` или `@USD2UAH_bot RUB 1000`
//
//В диалоге со мной можно узнать курсы валют \"командой\" валюты, это /usd /eur /rub , или воспользоваться кнопками
//
//Если у тебя будут проблемы с моей работой - пиши моему создателю, его контакты есть в описании.
//";
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();
        $repo = Connection::getRepository();
        /** @var User $user */
        $user = $message->getFrom();
        $userId = $user->getId();
        $config = $repo->getConfigByIdOrCreate($userId, null);
        $keyboard = new Keyboard(
            array_merge(json_decode($config['buttons']),  ['Settings'])
        );
        $text = json_encode($config);
        $keyboard->setResizeKeyboard(true);
        $data = [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => 'markdown',
            'disable_web_page_preview' => true,
            'reply_markup' => $keyboard,
        ];
        return Request::sendMessage($data);
    }
}
