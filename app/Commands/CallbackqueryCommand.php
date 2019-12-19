<?php


namespace Longman\TelegramBot\Commands\SystemCommands;
use Longman\TelegramBot\Commands\SystemCommand;
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
        \Longman\TelegramBot\TelegramLog::error($callback_query, [$callback_query_id]);
        \Longman\TelegramBot\TelegramLog::error($callback_query, [$callback_data]);
        $data = [
            'callback_query_id' => $callback_query_id,
            'text'              => "Hello World! {$callback_data}",
            'show_alert'        => true,
            'cache_time'        => 5,
        ];
        return Request::answerCallbackQuery($data);
    }
}
