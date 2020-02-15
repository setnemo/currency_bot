<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use CurrencyUaBot\Core\Connection;
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
    use Translatable;
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
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();

        $userId = $this->getMessage()->getFrom()->getId();
        $config = Connection::getRepository()->getConfigByIdOrCreate($userId, null);
        $lang = $config['lang'] ?? 'en';
        $buttons = json_decode($config['buttons'], true);
        $c = count($buttons);
        $e = 4 - $c;
        $buttonsText = implode("]\n[", $buttons);
        $text = "Now buttons: {$c}\n[{$buttonsText}]\n\nMax buttons with currency: 4\nEmpty slots: {$e}";
        $keyboard = new Keyboard(
            [$this->t('buttonsadd', $lang), $this->t('buttonsremove', $lang)],
            [$this->t('buttonsreset', $lang), $this->t('settings', $lang)],
            [$this->t('buttons', $lang)]
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
