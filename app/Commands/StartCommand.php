<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use CurrencyUaBot\Core\App;
use CurrencyUaBot\Core\Connection;
use CurrencyUaBot\Traits\Translatable;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\DB;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Entities\User;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Slim\PDO\Database;

/**
 * Start command
 *
 * Gets executed when a user first starts using the bot.
 */
class StartCommand extends SystemCommand
{
    use Translatable;

    /**
     * @var string
     */
    protected $name = 'start';
    /**
     * @var string
     */
    protected $description = 'Start command';
    /**
     * @var string
     */
    protected $usage = '/start';
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
     * @throws TelegramException
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
        $prepareButtons = $this->prepareButtons($config);
        $keyboard = new Keyboard(
            ...$prepareButtons
        );
        $keyboard->setResizeKeyboard(true);
        $text = $this->t('welcome_text', $config['lang'] ?? 'en');
        $data = [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => 'markdown',
            'disable_web_page_preview' => true,
            'reply_markup' => $keyboard,
        ];
        return Request::sendMessage($data);
    }

    protected function prepareButtons(array $config): array
    {
        $lang = $config['lang'] ?? 'en';
        $buttons = json_decode($config['buttons'], true);
        $tmp = [];
        $arg = [$this->t('settings', $lang)];

        foreach ($buttons as $it => $button) {
            if (($it + 1) % 3 === 0) {
                $tmp = array_merge($tmp, [$button]);
                $arg[] = $tmp;
                $tmp = [];
            } else {
                $tmp = array_merge($tmp, [$button]);
            }
        }
        if (!empty($tmp)) {
            $arg[] = $tmp;
        }
        return $arg;
    }
}
