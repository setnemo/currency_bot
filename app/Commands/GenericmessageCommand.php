<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Conversation;
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;

class GenericmessageCommand extends SystemCommand
{
    protected $name = 'genericmessage';
    protected $description = 'Handle generic message';
    protected $version = '1.0.0';

    public function execute()
    {
        $text = trim($this->getMessage()->getText(true));

        $update = json_decode($this->update->toJson(), true);
        $conversation = new Conversation(
            $this->getMessage()->getFrom()->getId(),
            $this->getMessage()->getChat()->getId(),
            $this->getName()
        );
        if ($text === "USD") {
            $update['message']['text'] = "EUR";
            $new = new Update($update, $this->getName());
            $newTg = $this->setUpdate($new);
            $command = new GenericmessageCommand($newTg->telegram,  $new);

            return $command->telegram->executeCommand("USD");
        }

        if ($text === "EUR") {
            $update['message']['text'] = "/EUR";
            return $this->telegram->executeCommand("EUR");
        }

        if ($text === "RUB") {
            $update['message']['text'] = "/RUB";
            return $this->telegram->executeCommand("RUB");
        }

        if ($text === "Settings") {
            return $this->telegram->executeCommand("settings");
        }

        $conversation->stop();
        return Request::emptyResponse();
    }
}