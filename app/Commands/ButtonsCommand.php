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
        $text    = "Кнопки включены.";
        /** @var Keyboard $keyboards */
        $keyboards = new Keyboard([
            'USD','EUR','RUB',
        ]);
        $keyboard = $keyboards
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(true)
            ->setSelective(false);

        $data = [
            'chat_id' => $chat_id,
            'text'    => $text,
            'reply_markup' => $keyboard,
        ];
        return Request::sendMessage($data);
    }
}
