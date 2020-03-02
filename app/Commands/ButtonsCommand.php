<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use CurrencyUaBot\Traits\ConfigAvailable;
use CurrencyUaBot\Traits\Translatable;
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
    use Translatable, ConfigAvailable;
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

        $config = $this->getConfigFromDb($this->getMessage()->getFrom()->getId());
        $lang = $config['lang'] ?? 'en';
        $buttons = json_decode($config['buttons'], true);
        $buttonsText = implode("]\n[", $buttons);
        $text = $this->t('buttons_description', $lang) . "\n[{$buttonsText}]";
        $keyboard = new Keyboard(
            [$this->t('buttonsreset', $lang), $this->t('settings', $lang)],
            [$this->t('buttons', $lang), $this->t('start', $lang)]
        );
        $keyboard->setResizeKeyboard(true);

        $data = [
            'chat_id' => $chat_id,
            'text' => $text,
            'parse_mode' => 'html',
            'disable_web_page_preview' => true,
            'reply_markup' => $keyboard,
        ];
        return Request::sendMessage($data);
    }
}
