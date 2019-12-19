<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Request;

/**
 * Start command
 *
 * Gets executed when a user first starts using the bot.
 */
class ButtonsCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'buttons';
    /**
     * @var string
     */
    protected $description = 'button command';
    /**
     * @var string
     */
    protected $usage = '/buttons';
    /**
     * @var string
     */
    protected $version = '1.1.0';
    /**
     * @var bool
     */
    /**
     * Command execute method
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $data = [
            'chat_id' => $this->getMessage()->getChat()->getId(),
            'text'    => "Кнопки включены.",
            'reply_markup' => new Keyboard([
                'USD','EUR','RUB',
            ]),
        ];
        return Request::sendMessage($data);
    }
}
