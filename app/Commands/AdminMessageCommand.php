<?php

namespace Longman\TelegramBot\Commands\AdminCommands;

use \Longman\TelegramBot\Commands\AdminCommand;
use Longman\TelegramBot\Request;

/**
 * Start command
 *
 * Gets executed when a user first starts using the bot.
 */
class AdminMessageCommand extends AdminCommand
{
    /**
     * @var string
     */
    protected $name = 'message';
    /**
     * @var string
     */
    protected $description = 'Message command';
    /**
     * @var string
     */
    protected $usage = '/message';
    /**
     * @var string
     */
    protected $version = '1.10.10';
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

        $text    = 'Hi there!';
        $data = [
            'chat_id' => $chat_id,
            'text'    => $text,
        ];
        return Request::sendMessage($data);
    }
}
