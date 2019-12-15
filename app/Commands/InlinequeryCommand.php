<?php
namespace Longman\TelegramBot\Commands\SystemCommands;
use GuzzleHttp\Client;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\InlineQuery\InlineQueryResultArticle;
use Longman\TelegramBot\Entities\InputMessageContent\InputTextMessageContent;
use Longman\TelegramBot\Request;

/**
 * Inline query command
 *
 * Command that handles inline queries.
 */
class InlinequeryCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'inlinequery';
    /**
     * @var string
     */
    protected $description = 'Reply to inline query';
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
        $inline_query = $this->getInlineQuery();
        $query        = $inline_query->getQuery();
        $data    = ['inline_query_id' => $inline_query->getId()];
        $results = [];
        if ($query !== '' && is_numeric($query) && $query > 0) {
            $gz = new Client();
            $info = $gz->request(
                'GET',
                'https://free.currconv.com/api/v7/convert?q=USD_UAH&compact=ultra&apiKey=' . getenv('EX_TOKEN')
            )->getBody()->getContents();
            $ex = json_decode($info);
            if (isset($ex->USD_UAH)) {
                $uah2usd = $query . 'UAH to USD: ' . round(floatval($query) / $ex->USD_UAH, 2);
                $usd2uah = $query . 'USD to UAH: ' . round(floatval($query) * $ex->USD_UAH, 2);
                $articles = [
                    [
                        'id'                    => '001',
                        'title'                 => '@USD2UAH_bot converter UAH to USD',
                        'description'           => $uah2usd,
                        'input_message_content' => new InputTextMessageContent(['message_text' => $uah2usd]),
                    ],
                    [
                        'id'                    => '002',
                        'title'                 => '@USD2UAH_bot converter USD to UAH',
                        'description'           => $usd2uah,
                        'input_message_content' => new InputTextMessageContent(['message_text' => $usd2uah]),
                    ],
                ];
            }
            foreach ($articles as $article) {
                $results[] = new InlineQueryResultArticle($article);
            }
        }
        $data['results'] = '[' . implode(',', $results) . ']';

        return Request::answerInlineQuery($data);
    }
}