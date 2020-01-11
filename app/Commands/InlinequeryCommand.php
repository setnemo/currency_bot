<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use GuzzleHttp\Client;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\InlineQuery\InlineQueryResultArticle;
use Longman\TelegramBot\Entities\InputMessageContent\InputTextMessageContent;
use Longman\TelegramBot\Exception\TelegramLogException;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\TelegramLog;
use CurrencyUaBot\Currency\MessageCreator;
use CurrencyUaBot\Currency\Api\Minfin;
use CurrencyUaBot\Currency\Api\Monobank;
use CurrencyUaBot\InlineEntityCreator;

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
     * @return bool|\Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $inline_query = $this->getInlineQuery();
        $query        = $inline_query->getQuery();
        $data         = ['inline_query_id' => $inline_query->getId()];
        $results      = [];

        /** @TODO Need refactor */
        if ($query !== '') {
            if (is_numeric($query) && $query > 0 ||
                stripos($query, 'usd') !== false && intval(substr(trim($query), 4)) > 0 ||
                stripos($query, 'rub') !== false && intval(substr(trim($query), 4)) > 0 ||
                stripos($query, 'eur') !== false && intval(substr(trim($query), 4)) > 0
            ) {

                if (stripos($query, 'usd') !== false ||
                    stripos($query, 'rub') !== false ||
                    stripos($query, 'eur') !== false
                ) {
                    $curr = trim(strtolower(substr($query, 0, 3)));
                    $query = intval(substr($query, 4));
                } else {
                    $curr = 'usd';
                }
                try {
                    $exchange = (new Minfin(new Client()))->getCurrencyMB();
                    $mono = (new Monobank(new Client()))->getContents();
                    \Longman\TelegramBot\TelegramLog::error('mono', [$mono]);
                } catch (\Exception $e) {
                    \Longman\TelegramBot\TelegramLog::error($e->getMessage());
                    return false;
                }
                $pre = ' ' . strtoupper($curr);
                /** @TODO Need refactor */
                $mb2 = 'Межбанк, продать' . $pre;
                $desc2 = MessageCreator::createMultiplyMessage($query, strtoupper($curr), 'UAH', $this->getCurrencyByKey($exchange, $curr, 'bid'));
                $mb1 = 'Межбанк, продать' . $pre;
                $desc1 = MessageCreator::createDivisionMessage($query, 'UAH', strtoupper($curr), $this->getCurrencyByKey($exchange, $curr, 'bid'));
                $mb3 = 'Межбанк, купить' . $pre;
                $desc3 = MessageCreator::createDivisionMessage($query, 'UAH', strtoupper($curr), $this->getCurrencyByKey($exchange, $curr, 'ask'));
                $mb4 = 'Межбанк, купить' . $pre;
                $desc4 = MessageCreator::createMultiplyMessage($query, strtoupper($curr), 'UAH', $this->getCurrencyByKey($exchange, $curr, 'ask'));
                $articles = [
                    $this->getFillTemplate($mb4, $desc4, $this->getCurrencyByKey($exchange, $curr, 'ask')),
                    $this->getFillTemplate($mb3, $desc3, $this->getCurrencyByKey($exchange, $curr, 'ask')),
                    $this->getFillTemplate($mb2, $desc2, $this->getCurrencyByKey($exchange, $curr, 'bid')),
                    $this->getFillTemplate($mb1, $desc1, $this->getCurrencyByKey($exchange, $curr, 'bid')),
                ];
                foreach ($articles as $article) {
                    $results[] = $article;
                }
            }
        }
        $data['results'] = '[' . implode(',', $results) . ']';

        return Request::answerInlineQuery($data);
    }

    /**
     * @param string $mb
     * @param string $desc
     * @param string $exchange
     * @return InlineQueryResultArticle
     */
    private function getFillTemplate(string $mb, string $desc, string $exchange): InlineQueryResultArticle
    {
        return InlineEntityCreator::getInstance()->fillTemplate(
            $mb,
            $desc,
            $mb . PHP_EOL . $desc
        //. PHP_EOL . $this->getSignText($exchange)
        );
    }

    /**
     * @param array $exchange
     * @param string $curr
     * @param string $key
     * @return mixed
     */
    private function getCurrencyByKey(array $exchange, string $curr, string $key)
    {
        return $exchange[$curr][$key];
    }
}