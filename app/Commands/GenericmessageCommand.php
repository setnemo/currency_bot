<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Commands\UserCommands\HelpCommand;
use Longman\TelegramBot\Commands\UserCommands\WhoamiCommand;
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Request;

class GenericmessageCommand extends SystemCommand
{
    protected $name = 'Genericmessage';
    protected $description = 'Handle generic message';
    protected $version = '1.0.0';

    protected const BUTTONS = [
        'USD',
        'RUB',
        'EUR',
    ];

    public function execute()
    {
        $text = trim($this->getMessage()->getText(true));

        $update = json_decode($this->update->toJson(), true);

        foreach (self::BUTTONS as $button) {
            if ($text === $button) {
                $update['message']['text'] = "/{$button}";
                $command = $button . 'Command';
                return (new $command($this->telegram, new Update($update)))->preExecute();
            }
        }
        return Request::emptyResponse();
    }
}