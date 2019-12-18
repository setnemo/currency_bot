<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use GuzzleHttp\Client;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\InlineQuery\InlineQueryResultArticle;
use Longman\TelegramBot\Entities\InputMessageContent\InputTextMessageContent;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\TelegramLog;
use USD2UAH\Currency\MessageCreator;
use USD2UAH\Currency\MinfinApi;
use USD2UAH\InlineEntityCreator;

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
//            $user = $inline_query->getFrom()->getId();
//            if (intval($user) !== intval(getenv('ADMIN'))) {
//                $gz = new Client();
//                $info = $gz->request(
//                'GET',
//                'https://free.currconv.com/api/v7/convert?q=USD_UAH&compact=ultra&apiKey=' . getenv('EX_TOKEN')
//                )->getBody()->getContents();
//                $ex = json_decode($info);
//                if (isset($ex->USD_UAH)) {
//                    $uah2usd = $query . 'UAH to USD: ' . round(floatval($query) / $ex->USD_UAH, 2);
//                    $usd2uah = $query . 'USD to UAH: ' . round(floatval($query) * $ex->USD_UAH, 2);
//                    $articles = [
//                        [
//                            'id' => '001',
//                            'title' => '@USD2UAH_bot converter UAH to USD',
//                            'description' => $uah2usd,
//                            'input_message_content' => new InputTextMessageContent(['message_text' => $uah2usd]),
//                        ],
//                        [
//                            'id' => '002',
//                            'title' => '@USD2UAH_bot converter USD to UAH',
//                            'description' => $usd2uah,
//                            'input_message_content' => new InputTextMessageContent(['message_text' => $usd2uah]),
//                        ],
//                    ];
//                    foreach ($articles as $article) {
//                        $results[] = new InlineQueryResultArticle($article);
//                    }
//                }
//            } else {
            /** @TODO Need refactor */
                $exchange = (new MinfinApi())->getCurrencyList();
                $mb2 = 'Межбанк, продать доллар';
                $desc2 = MessageCreator::createMultiplyMessage($query, 'USD', 'UAH', $exchange[MinfinApi::MB]['usd']['bid']);
                $mb1 = 'Межбанк, продать доллар';
                $desc1 = MessageCreator::createDivisionMessage($query, 'UAH', 'USD', $exchange[MinfinApi::MB]['usd']['bid']);
                $mb3 = 'Межбанк, купить доллар';
                $desc3 = MessageCreator::createDivisionMessage($query, 'UAH', 'USD', $exchange[MinfinApi::MB]['usd']['ask']);
                $mb4 = 'Межбанк, купить доллар';
                $desc4 = MessageCreator::createMultiplyMessage($query, 'USD', 'UAH', $exchange[MinfinApi::MB]['usd']['ask']);
                $articles = [
                    InlineEntityCreator::getInstance()->fillTemplate(
                        $mb4,
                        $desc4,
                        $mb4 . PHP_EOL . $desc4 . PHP_EOL . $this->getSignText($exchange[MinfinApi::MB]['usd']['ask'])
                    ),
                    InlineEntityCreator::getInstance()->fillTemplate(
                        $mb3,
                        $desc3,
                        $mb3 . PHP_EOL . $desc3 . PHP_EOL . $this->getSignText($exchange[MinfinApi::MB]['usd']['ask'])
                    ),
                    InlineEntityCreator::getInstance()->fillTemplate(
                        $mb2,
                        $desc2,
                        $mb2 . PHP_EOL . $desc2 . PHP_EOL . $this->getSignText($exchange[MinfinApi::MB]['usd']['bid'])
                    ),
                    InlineEntityCreator::getInstance()->fillTemplate(
                        $mb1,
                        $desc1,
                        $mb1 . PHP_EOL . $desc1 . PHP_EOL . $this->getSignText($exchange[MinfinApi::MB]['usd']['bid'])
                    ),
                ];
                foreach ($articles as $article) {
                    $results[] = $article;
                }
            }
//        }
        $data['results'] = '[' . implode(',', $results) . ']';

        return Request::answerInlineQuery($data);
    }

    private function getSignText(string $ex): string
    {
        return "<a href=\"https://minfin.com.ua/currency/?utm_source=telegram&utm_medium=USD2UAH_bot&utm_compaign=inline_bot_post\">Курс</a>: {$ex}";
    }
}