<?php

namespace Longman\TelegramBot\Commands\UserCommands;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Request;
/**
 * User "/keyboard" command
 *
 * Display a keyboard with a few buttons.
 */
class KeyboardCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'keyboard';
    /**
     * @var string
     */
    protected $description = 'Show a custom keyboard with reply markup';
    /**
     * @var string
     */
    protected $usage = '/keyboard';
    /**
     * @var string
     */
    protected $version = '0.2.0';
    /**
     * Command execute method
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        /** @var Keyboard $keyboards */
        $keyboards = new Keyboard([
            [
                [
                    'text' => 'USD'
                ],
                [
                    'text' => 'EUR'
                ],
                [
                    'text' => 'RUB'
                ],
            ],
        ]);
        //Return a random keyboard.
        $keyboard = $keyboards
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(true)
            ->setSelective(false);
        $chat_id = $this->getMessage()->getChat()->getId();
        $data    = [
            'chat_id'      => $chat_id,
            'text'         => 'Press a Button:',
            'reply_markup' => $keyboard,
        ];
        return Request::sendMessage($data);
    }
}
