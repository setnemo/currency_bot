<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use CurrencyUaBot\Traits\CurrencyConvertable;
use CurrencyUaBot\Traits\Translatable;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Conversation;
use Longman\TelegramBot\Request;

class GenericmessageCommand extends SystemCommand
{
    use Translatable, CurrencyConvertable;

    protected $name = 'genericmessage';
    protected $description = 'Handle generic message';
    protected $version = '2.0.0';

    public function execute()
    {
        $text = trim($this->getMessage()->getText(true));

        $conversation = new Conversation(
            $this->getMessage()->getFrom()->getId(),
            $this->getMessage()->getChat()->getId(),
            $this->getName()
        );

        if ($this->isCurrency($text) || $this->isCurrency(explode(' ', $text)[0] ?? '') ) {
            return $this->telegram->executeCommand('Currency');
        }

        if ($command = $this->d($text)) {
            if (strstr($command, 'help')) {
                $command = explode('_', $command)[0];
            }
            return $this->telegram->executeCommand($command);
        }

        $conversation->stop();
        return Request::emptyResponse();
    }
}