<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use CurrencyUaBot\Core\App;
use CurrencyUaBot\Core\Connection;
use CurrencyUaBot\Currency\Api\Factory\CurrencyContentStaticFactory;
use CurrencyUaBot\Currency\Api\Providers\Minfin;
use CurrencyUaBot\Currency\CurrencyEntity;
use CurrencyUaBot\Traits\Translatable;
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
class LanguageCommand extends UserCommand
{
    use Translatable;

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
    protected $usage = '/language';
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
        $chat_id =  $this->getMessage()->getChat()->getId();
        $userId = $this->getMessage()->getFrom()->getId();
        $config = Connection::getRepository()->getConfigByIdOrCreate($userId, null);
        $lang = $config['lang'] ?? 'en';
        $keyboard = new InlineKeyboard([
            ['text' => $this->t('russian', $lang), 'callback_data' => "change_lang_ru_{$userId}_{$chat_id}"],
            ['text' => $this->t('ukrainian', $lang), 'callback_data' => "change_lang_uk_{$userId}_{$chat_id}"],
        ],
            [['text' => $this->t('english', $lang), 'callback_data' => "change_lang_en_{$userId}_{$chat_id}"]]
        );
        $data = [
            'chat_id' => $this->getMessage()->getChat()->getId(),
            'text'    => $this->t('choice_lang', $lang),
            'reply_markup' => $keyboard,
        ];
        return Request::sendMessage($data);
    }
}
