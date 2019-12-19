<?php


namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Commands\UserCommands\USDCommand;
use Longman\TelegramBot\Commands\UserCommands\RUBCommand;
use Longman\TelegramBot\Commands\UserCommands\EURCommand;
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Request;

class GenericmessageCommand extends SystemCommand
{
    protected $name = 'genericmessage';
    protected $description = 'Handle generic message';
    protected $version = '1.0.0';

    public function execute()
    {
        $text = trim($this->getMessage()->getText(true));

        $update = json_decode($this->update->toJson(), true);
        \Longman\TelegramBot\TelegramLog::error('test', $text);
        \Longman\TelegramBot\TelegramLog::error('test', $update);
            if ($text === "USD") {
                \Longman\TelegramBot\TelegramLog::error('USD');
                $update['message']['text'] = "/USD";
                return (new USDCommand($this->telegram, new Update($update)))->preExecute();
            }
            if ($text === "RUB") {
                \Longman\TelegramBot\TelegramLog::error('RUB');
                $update['message']['text'] = "/RUB";
                return (new RUBCommand($this->telegram, new Update($update)))->preExecute();
            }
            if ($text === "EUR") {
                \Longman\TelegramBot\TelegramLog::error('EUR');
                $update['message']['text'] = "/EUR";
                return (new EURCommand($this->telegram, new Update($update)))->preExecute();
            }
        return Request::emptyResponse();
    }
}