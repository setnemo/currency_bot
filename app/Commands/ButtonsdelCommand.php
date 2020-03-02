<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use CurrencyUaBot\Core\Connection;
use CurrencyUaBot\Core\DbRepository;
use CurrencyUaBot\Traits\ConfigAvailable;
use CurrencyUaBot\Traits\CurrencyConvertable;
use CurrencyUaBot\Traits\Translatable;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\User;
use Longman\TelegramBot\Request;

/**
 * Start command
 *
 * Gets executed when a user first starts using the bot.
 */
class ButtonsdelCommand extends UserCommand
{
    use Translatable, CurrencyConvertable, ConfigAvailable;

    protected $name = 'buttons del';
    /**
     * @var string
     */
    protected $description = 'button del command';
    /**
     * @var string
     */
    protected $usage = '/buttonsdel <button>';
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
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();
        $text = $message->getText();
        /** @var User $user */
        $user = $message->getFrom();
        $userId = $user->getId();
        $config = $this->getConfigFromDb($userId, $user->getLanguageCode());
        $lang = $config['lang'] ?? 'en';
        if (strpos($text, 'buttonsdel')) {
            $arr = explode('buttonsdel', $text);
            if (isset($arr[1])) {
                $currency = trim(strtoupper($arr[1]));
                if ($this->isCurrency($currency) && $this->delButton($currency, Connection::getRepository(), $userId, $config)) {
                    // add button
                    $text = $this->t('button_del_success', $lang);
                } else {
                    $text = $this->t('button_del_error', $lang) . '[' . $arr[1] . ']';

                }
            }
        } else {
            $text = $this->t('button_del_error', $lang);
        }
        $data = [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => 'markdown',
            'disable_web_page_preview' => true,
        ];
        return Request::sendMessage($data);
    }

    /**
     * @param string $currency
     * @param DbRepository $repo
     * @param int $userId
     * @param array $config
     * @return bool
     */
    private function delButton(string $currency, DbRepository $repo, int $userId, array $config): bool
    {
        $buttons = json_decode($config['buttons'], true);
        if (!in_array($currency, $buttons)) {
            return false;
        }
        $buttons[array_search($currency, $buttons)] = null;
        $buttons = array_filter($buttons);
        return $repo->updateButtons($userId, $buttons);
    }
}
