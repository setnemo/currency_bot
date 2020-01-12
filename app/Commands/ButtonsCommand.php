<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\InlineKeyboard;
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


        $switch_element = mt_rand(0, 9) < 5 ? 'true' : 'false';
        $keyboard = new InlineKeyboard([
            ['text' => 'inline', 'switch_inline_query' => $switch_element],
            ['text' => 'inline current chat', 'switch_inline_query_current_chat' => $switch_element],
        ], [
            ['text' => 'callback', 'callback_data' => 'identifier'],
            ['text' => 'open url', 'url' => 'https://github.com/php-telegram-bot/core'],
        ]);
//            ->setResizeKeyboard(true)
//            ->setOneTimeKeyboard(true)
//            ->setSelective(false)
        ;

//        $keyboard = Keyboard::remove();
//        $data = [
//            'chat_id' => $this->getMessage()->getChat()->getId(),
//            'text'    => "Кнопки включены.",
//            'reply_markup' => $keyboard,
//        ];
        $data = [
            'chat_id' => $this->getMessage()->getChat()->getId(),
            'text'    => "Кнопки включены.",
            'reply_markup' => $keyboard,
        ];
        return Request::sendMessage($data);
    }
}
