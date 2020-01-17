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
        $case         = 'Monobank'; // need get from settings_users table;

        /** @TODO Need refactor */
        if ($query !== '') {
            if (is_numeric($query) && $query > 0 || intval(substr(trim($query), 4)) > 0) {
                if ($query > 0) {
                    $curr = 'usd';
                } else {
                    $curr = trim(strtolower(substr($query, 0, 3)));
                    $query = intval(substr($query, 4));
                }
                try {
//                    $entity = (new Minfin(new Client()))->freshCurrency(Minfin::MB);
                    $entity = (new Monobank(new Client()))->freshCurrency();
                } catch (\Exception $e) {
                    \Longman\TelegramBot\TelegramLog::error($e->getMessage());
                    return false;
                }
                $pre = ' ' . strtoupper($curr);
                /** @TODO Need refactor */
                $mb2 = 'Межбанк, продать' . $pre;
                $desc2 = MessageCreator::createMultiplyMessage($query, strtoupper($curr), 'UAH', $entity->getBuy($curr));
                $mb1 = 'Межбанк, продать' . $pre;
                $desc1 = MessageCreator::createDivisionMessage($query, 'UAH', strtoupper($curr), $entity->getBuy($curr));
                $mb3 = 'Межбанк, купить' . $pre;
                $desc3 = MessageCreator::createDivisionMessage($query, 'UAH', strtoupper($curr), $entity->getSale($curr));
                $mb4 = 'Межбанк, купить' . $pre;
                $desc4 = MessageCreator::createMultiplyMessage($query, strtoupper($curr), 'UAH', $entity->getSale($curr));
                $articles = [
                    $this->getFillTemplate($mb4, $desc4, $entity->getSale($curr)),
                    $this->getFillTemplate($mb3, $desc3, $entity->getSale($curr)),
                    $this->getFillTemplate($mb2, $desc2, $entity->getBuy($curr)),
                    $this->getFillTemplate($mb1, $desc1, $entity->getBuy($curr)),
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