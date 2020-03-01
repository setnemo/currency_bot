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
class ButtonsresetCommand extends UserCommand
{
    use Translatable;
    /**
     * @var string
     */
    protected $name = 'reset buttons';
    /**
     * @var string
     */
    protected $description = 'button command';
    /**
     * @var string
     */
    protected $usage = '/resetbuttons';
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
        $userId = $this->getMessage()->getFrom()->getId();
        Connection::getRepository()->updateButtons($userId, [], true);
        return $this->telegram->executeCommand('Buttons');
    }
}
