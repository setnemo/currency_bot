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
class InlinesourceCommand extends UserCommand
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
    protected $usage = '/inline';
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
        $userId = $this->getMessage()->getFrom()->getId();
        $config = Connection::getRepository()->getConfigByIdOrCreate($userId, null);
        $lang = $config['lang'] ?? 'en';
        $inline = \GuzzleHttp\json_decode($config['inline'], true);
        $allApis = CurrencyContentStaticFactory::ALLOWED_API;
        $myApis = $inline['available_api'];
        $arg = $this->getKeyboardArgs($allApis, $lang, $userId);
        $keyboard = new InlineKeyboard(...$arg);
        $data = [
            'chat_id' => $this->getMessage()->getChat()->getId(),
            'text'    => $this->t('choice_inline', $lang) . PHP_EOL . $this->getAvailableCurrencies($myApis, $lang),
            'reply_markup' => $keyboard,
        ];
        return Request::sendMessage($data);
    }

    private function getAvailableCurrencies(array $apis, string $lang): string
    {
        $allApis = CurrencyContentStaticFactory::ALLOWED_API;
        $text = '';
        foreach ($allApis as $api) {
            $apiName = $this->t($api, $lang);
            $check = in_array($api, $apis) ? '✅' : '️❌';
            $text .=  "{$apiName}\t{$check}\n";
        }
        return $text;
    }

    /**
     * @param array $allApis
     * @param string $lang
     * @param int $userId
     * @return array
     */
    private function getKeyboardArgs(array $allApis, string $lang, int $userId): array
    {
        $tmp = $arg = [];
        foreach ($allApis as $it => $api) {
            if ($it % 2 === 0) {
                $tmp[] = ['text' => $this->t($api, $lang), 'callback_data' => "change_inline_{$userId}_{$api}"];
                $arg[] = $tmp;
                $tmp = [];
            } else {
                $tmp[] = ['text' => $this->t($api, $lang), 'callback_data' => "change_inline_{$userId}_{$api}"];
            }
        }
        if (!empty($tmp)) {
            $arg[] = $tmp;
        }
        return $arg;
    }
}
