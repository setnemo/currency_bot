<?php

namespace Longman\TelegramBot\Commands\SystemCommands;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Commands\UserCommands\ButtonsCommand;
use Longman\TelegramBot\Commands\UserCommands\EURCommand;
use Longman\TelegramBot\Commands\UserCommands\RUBCommand;
use Longman\TelegramBot\Commands\UserCommands\USDCommand;
use Longman\TelegramBot\Entities\Update;
use Longman\TelegramBot\Request;
use USD2UAH\Currency\MinfinApi;

/**
 * Callback query command
 *
 * This command handles all callback queries sent via inline keyboard buttons.
 *
 * @see ButtonsCommand.php
 */
class CallbackqueryCommand extends SystemCommand
{
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


        \Longman\TelegramBot\TelegramLog::error('test');
        if ($callback_data === "USD") {
            \Longman\TelegramBot\TelegramLog::error('USD');
            $exchange = (new MinfinApi())->getCurrencyList();
            $text = USDCommand::getExchangeTextUSD($exchange);
            $update = json_decode($this->update->toJson(), true);
            return (new RUBCommand($this->telegram, new Update($update)))->preExecute();
        }


        $data = [
            'callback_query_id' => $callback_query_id,
            'text'              => $text ?? 'uuuups',
            'show_alert'        => true,
            'cache_time'        => 5,
        ];
        return Request::answerCallbackQuery($data);
    }
}
