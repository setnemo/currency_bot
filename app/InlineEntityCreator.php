<?php

namespace CurrencyUaBot;

use Longman\TelegramBot\Entities\InlineQuery\InlineQueryResultArticle;
use Longman\TelegramBot\Entities\InputMessageContent\InputTextMessageContent;

class InlineEntityCreator
{
    protected $id = 0;

    private static $instance = null;

    /**
     * @return InlineEntityCreator
     */
    public static function getInstance(): InlineEntityCreator
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * @param string $title
     * @param string $description
     * @param string $message
     * @return InlineQueryResultArticle
     */
    public function fillTemplate(string $title, string $description, string $message): InlineQueryResultArticle
    {
        $this->id += 1;
        return new InlineQueryResultArticle([
            'id'                    => sprintf('%004d', $this->id),
            'title'                 => $title,
            'description'           => $description,
            'input_message_content' => new InputTextMessageContent([
                'message_text' => $message,
                'parse_mode' => 'HTML',
                'disable_web_page_preview' => true,
            ]),
        ]);
    }

    private function __construct()
    {
        //
    }

    private function __clone()
    {
        //
    }

    private function __wakeup()
    {
        //
    }
}