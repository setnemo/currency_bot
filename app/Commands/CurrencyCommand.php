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
class CurrencyCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'Currency';
    /**
     * @var string
     */
    protected $description = 'Currency command';
    /**
     * @var string
     */
    protected $usage = '/currency <currency>';
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
            'text' => "$ t e x t {$text}",
            'parse_mode' => 'markdown',
            'disable_web_page_preview' => true,
        ];
        return Request::sendMessage($data);
    }
}
