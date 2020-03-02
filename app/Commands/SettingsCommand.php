<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use CurrencyUaBot\Core\App;
use CurrencyUaBot\Core\Connection;
use CurrencyUaBot\Currency\Api\Factory\CurrencyContentStaticFactory;
use CurrencyUaBot\Currency\Api\Providers\Minfin;
use CurrencyUaBot\Currency\CurrencyEntity;
use CurrencyUaBot\Traits\Cacheable;
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
class SettingsCommand extends UserCommand
{
    use Translatable, Cacheable;

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
    protected $usage = '/settings';
    /**
     * @var string
     */
    protected $version = '2.0.0';
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
        $config = $repo->getConfigByIdOrCreate($userId, $user->getLanguageCode());
        $lang = $config['lang'] ?? 'en';
        $keyboard = new Keyboard(
            [$this->t('language', $lang), $this->t('source', $lang)],
            [$this->t('buttons', $lang), $this->t('start', $lang)]
        );
        $text = $this->t('settings_text', $lang);
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
