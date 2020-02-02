<?php

namespace Longman\TelegramBot\Commands\UserCommands;

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
     * @return ServerResponse
     * @throws TelegramException
     * @throws ReflectionException
     */
    public function execute()
    {
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();
        $text = $message->getText();
        $data = [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => 'markdown',
            'disable_web_page_preview' => true,
        ];
        return Request::sendMessage($data);
    }
}

/**
 *
 **НБУ**
 * Покупка: {$exchange[Minfin::NBU]['eur']['bid']}
 * Продажа: {$exchange[Minfin::NBU]['eur']['ask']}
 */
