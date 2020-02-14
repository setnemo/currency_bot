<?php

namespace CurrencyUaBot\Commands;

namespace Longman\TelegramBot\Commands\SystemCommands;

use CurrencyUaBot\Core\Connection;
use CurrencyUaBot\Traits\Cacheable;
use CurrencyUaBot\Traits\Translatable;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Entities\User;
use Longman\TelegramBot\Request;

/**
 * Callback query command
 *
 * This command handles all callback queries sent via inline keyboard buttons.
 *
 * @see InlinekeyboardCommand.php
 */
class CallbackqueryCommand extends SystemCommand
{
    use Cacheable, Translatable;
    /**
     * @var string
     */
    protected $name = 'callbackquery';

    /**
     * @var string
     */
    protected $description = 'Reply to callback query';

    /**
     * @var string
     */
    protected $version = '1.1.1';

    /**
     * Command execute method
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $callback_query    = $this->getCallbackQuery();
        $callback_query_id = $callback_query->getId();
        $callback_data     = $callback_query->getData();

        $text = '';
        $array = explode('_', $callback_data);
        if ($this->isChangeLanguage($array)) {
            $data = $this->changeLanguage($array);
            return Request::sendMessage($data);
        }
        if ($this->isChangeInline($array)) {
            $text = $this->changeInline($array);
        }

        return Request::answerCallbackQuery([
            'callback_query_id' => $callback_query_id,
            'text'              => empty($text) ? 'Something went wrong!' : $text,
            'show_alert'        => true,
            'cache_time'        => 3,
        ]);
    }

    /**
     * @param array $array
     * @return array
     */
    private function changeLanguage(array $array): array
    {
        $userId = $array[3] ?? 0;
        $this->updateLanguageCode($array, $userId);
        $config = $this->getConfigFromDb($userId, $array[2] ?? 'en');

        $lang = $config['lang'] ?? 'en';
        $keyboard = $this->getSettingsKeyboard($lang);
        return [
            'chat_id' => $array[4] ?? 0,
            'text' => $this->t('language_changed', $lang),
            'parse_mode' => 'markdown',
            'disable_web_page_preview' => true,
            'reply_markup' => $keyboard,
        ];
    }

    /**
     * @param array $array
     * @return string
     */
    private function changeInline(array $array): string
    {
        $text = '';
        $userId = $array[2] ?? 0;
        $api = $array[3] ?? 0;
        $config = $this->getConfigFromDb($userId, null);
        $lang = $config['lang'] ?? 'en';
        $inline = json_decode($config['inline'], true);
        $apis = $inline['available_api'];
        if (in_array($api, $apis)) {
            if (count($apis) === 1) {
                return $this->t('remove_api_denied', $lang);
            }
            foreach ($apis as $it => $key) {
                if ($key === $api) {
                    unset($apis[$it]);
                }
            }
            $this->updateApiFromConfig($userId, $apis);
            $text .= $this->t('remove_api', $lang);
        } else {
            $apis = array_merge($apis, [$api]);
            $this->updateApiFromConfig($userId, $apis);
            $text .= $this->t('add_api', $lang);
        }
        return $text;
    }

    /**
     * @param string $lang
     * @return Keyboard
     */
    private function getSettingsKeyboard(string $lang): Keyboard
    {
        $keyboard = new Keyboard(
            [$this->t('language', $lang), $this->t('inlinesource', $lang)],
            [$this->t('buttons', $lang), $this->t('help', $lang)],
            [$this->t('start', $lang)]
        );
        $keyboard->setResizeKeyboard(true);
        return $keyboard;
    }

    /**
     * @param int $userId
     * @param string|null $lang
     * @return array
     */
    private function getConfigFromDb(int $userId, ?string $lang): array
    {
        return Connection::getRepository()->getConfigByIdOrCreate($userId, $lang);
    }

    /**
     * @param array $array
     * @return bool
     */
    private function isChangeLanguage(array $array): bool
    {
        return 'change' === $array[0] && 'lang' == $array[1];
    }

    /**
     * @param array $array
     * @return bool
     */
    private function isChangeInline(array $array): bool
    {
        return 'change' === $array[0] && 'inline' == $array[1];
    }

    /**
     * @param array $array
     * @param int $userId
     */
    private function updateLanguageCode(array $array, int $userId): void
    {
        Connection::getRepository()->updateLanguageCode($userId, $array[2] ?? 'en');
    }

    /**
     * @param int $userId
     * @param array $api
     */
    private function updateApiFromConfig(int $userId, array $apis): void
    {
        Connection::getRepository()->updateApiFromConfig($userId, $apis);
    }
}
