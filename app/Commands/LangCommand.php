<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use CurrencyUaBot\Core\App;
use CurrencyUaBot\Core\Connection;
use CurrencyUaBot\Currency\Api\Factory\CurrencyContentStaticFactory;
use CurrencyUaBot\Currency\Api\Providers\Minfin;
use CurrencyUaBot\Currency\CurrencyEntity;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\InlineKeyboard;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Entities\User;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use ReflectionException;

/**
 * Start command
 *
 * Gets executed when a user first starts using the bot.
 */
class LangCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'Settings';
    /**
     * @var string
     */
    protected $description = 'Settings command';
    /**
     * @var string
     */
    protected $usage = '/lang';
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
     * @throws GuzzleException
     * @throws TelegramException
     * @throws ReflectionException
     */
    public function execute()
    {
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
        $keyboard = new InlineKeyboard([
            ['text' => 'callback', 'callback_data' => 'identifier'],
            ['text' => 'callback', 'callback_data' => 'identifier'],
        ], [
            ['text' => 'callback', 'callback_data' => 'identifier'],
            ['text' => 'callback', 'callback_data' => 'identifier'],
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
