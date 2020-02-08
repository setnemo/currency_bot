<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use CurrencyUaBot\Traits\CurrencyConvertable;
use CurrencyUaBot\Traits\Translatable;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Conversation;
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Request;

class GenericmessageCommand extends SystemCommand
{
    use Translatable, CurrencyConvertable;

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

        if ($this->isCurrency($text)) {
            /// need save to cache
            return $this->telegram->executeCommand('Currency');
        }

        if ($text = $this->d($text)) {
            return $this->telegram->executeCommand($text);
        }

        $conversation->stop();
        return Request::emptyResponse();
    }
}