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
        if ($query !== '') {
            if (is_numeric($query) && $query > 0 ||
                stripos($query, 'usd') !== false && intval(substr(trim($query), 4)) > 0 ||
                stripos($query, 'rub') !== false && intval(substr(trim($query), 4)) > 0 ||
                stripos($query, 'eur') !== false && intval(substr(trim($query), 4)) > 0 ||
            ) {

                if (stripos($query, 'usd') !== false ||
                    stripos($query, 'rub') !== false ||
                    stripos($query, 'eur') !== false
                ) {
                    $curr = strtolower(substr(trim($query), 0, 3));
                    $query = intval(substr(trim($query), 4));
                } else {
                    $curr = 'usd';
                }
                /** @TODO Need refactor */
                $exchange = (new MinfinApi())->getCurrencyList();
                $mb2 = 'Межбанк, продать доллар';
                $desc2 = MessageCreator::createMultiplyMessage($query, strtoupper($curr), 'UAH', $exchange[MinfinApi::MB][$curr]['bid']);
                $mb1 = 'Межбанк, продать доллар';
                $desc1 = MessageCreator::createDivisionMessage($query, 'UAH', strtoupper($curr), $exchange[MinfinApi::MB][$curr]['bid']);
                $mb3 = 'Межбанк, купить доллар';
                $desc3 = MessageCreator::createDivisionMessage($query, 'UAH', strtoupper($curr), $exchange[MinfinApi::MB][$curr]['ask']);
                $mb4 = 'Межбанк, купить доллар';
                $desc4 = MessageCreator::createMultiplyMessage($query, strtoupper($curr), 'UAH', $exchange[MinfinApi::MB][$curr]['ask']);
                $articles = [
                    InlineEntityCreator::getInstance()->fillTemplate(
                        $mb4,
                        $desc4,
                        $mb4 . PHP_EOL . $desc4 . PHP_EOL . $this->getSignText($exchange[MinfinApi::MB][$curr]['ask'])
                    ),
                    InlineEntityCreator::getInstance()->fillTemplate(
                        $mb3,
                        $desc3,
                        $mb3 . PHP_EOL . $desc3 . PHP_EOL . $this->getSignText($exchange[MinfinApi::MB][$curr]['ask'])
                    ),
                    InlineEntityCreator::getInstance()->fillTemplate(
                        $mb2,
                        $desc2,
                        $mb2 . PHP_EOL . $desc2 . PHP_EOL . $this->getSignText($exchange[MinfinApi::MB][$curr]['bid'])
                    ),
                    InlineEntityCreator::getInstance()->fillTemplate(
                        $mb1,
                        $desc1,
                        $mb1 . PHP_EOL . $desc1 . PHP_EOL . $this->getSignText($exchange[MinfinApi::MB][$curr]['bid'])
                    ),
                ];
                foreach ($articles as $article) {
                    $results[] = $article;
                }
            }
        }
        $data['results'] = '[' . implode(',', $results) . ']';

        return Request::answerInlineQuery($data);
    }

    private function getSignText(string $ex): string
    {
        return "<a href=\"https://minfin.com.ua/currency/?utm_source=telegram&utm_medium=USD2UAH_bot&utm_compaign=inline_bot_post\">Курс</a>: {$ex}";
    }
}