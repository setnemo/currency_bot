<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use CurrencyUaBot\Currency\Api\CurrencyContent;
use CurrencyUaBot\Currency\Api\Factory\CurrencyContentStaticFactory;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\InlineQuery\InlineQueryResultArticle;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;
use CurrencyUaBot\Currency\MessageCreator;
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
    protected $version = '1.1.0';

    /**
     * Command execute method
     *
     * @return bool|ServerResponse
     */
    public function execute()
    {
        $inline_query = $this->getInlineQuery();
        $query        = $inline_query->getQuery();
        $data         = ['inline_query_id' => $inline_query->getId()];
        $results      = [];
        $case         = [
            CurrencyContentStaticFactory::MONOBANK,
            CurrencyContentStaticFactory::MINFIN_MB,
        ]; // need get from settings_users table;

        if ($query !== '') {
            if (is_numeric($query) && $query > 0 || intval(substr(trim($query), 4)) > 0) {
                if ($query > 0) {
                    $currency = 'usd';
                } else {
                    $currency = trim(strtolower(substr($query, 0, 3)));
                    $query = intval(substr($query, 4));
                }
                $this->fillResults($this->getArticles($case, $currency, $query), $results);
            }
        }
        $data['results'] = '[' . implode(',', $results) . ']';

        return Request::answerInlineQuery($data);
    }

    /**
     * @param string $title
     * @param string $desc
     * @return InlineQueryResultArticle
     */
    private function getFillTemplate(string $title, string $desc): InlineQueryResultArticle
    {
        return InlineEntityCreator::getInstance()->fillTemplate($title, $desc, $title . PHP_EOL . $desc);
    }

    /**
     * @param string $currency
     * @param string $query
     * @param CurrencyContent $entity
     * @return array
     */
    private function fillArticles(string $currency, string $query, CurrencyContent $entity): array
    {
        $pre = ' ' . strtoupper($currency);
        /** @TODO Need refactor */
        $mb2 = "{$entity->getSourceName()}, продать" . $pre;
        $desc2 = MessageCreator::createMultiplyMessage($query, strtoupper($currency), 'UAH', $entity->getBuy($currency));
        $mb1 = "{$entity->getSourceName()}, продать" . $pre;
        $desc1 = MessageCreator::createDivisionMessage($query, 'UAH', strtoupper($currency), $entity->getBuy($currency));
        $mb3 = "{$entity->getSourceName()}, купить" . $pre;
        $desc3 = MessageCreator::createDivisionMessage($query, 'UAH', strtoupper($currency), $entity->getSale($currency));
        $mb4 = "{$entity->getSourceName()}, купить" . $pre;
        $desc4 = MessageCreator::createMultiplyMessage($query, strtoupper($currency), 'UAH', $entity->getSale($currency));
        return [
            $this->getFillTemplate($mb4, $desc4),
            $this->getFillTemplate($mb3, $desc3),
            $this->getFillTemplate($mb2, $desc2),
            $this->getFillTemplate($mb1, $desc1),
        ];
    }

    /**
     * @param array $case
     * @param string $curr
     * @param string $query
     * @return array
     */
    private function getArticles(array $case, string $curr, string $query): array
    {
        $articles = [];
        foreach ($case as $type) {
            try {
                $entity = CurrencyContentStaticFactory::factory($type);
                $articles = array_merge($this->fillArticles($curr, $query, $entity), $articles);
            } catch (\Exception $e) {
                \Longman\TelegramBot\TelegramLog::notice($e->getMessage());
                continue;
            }
        }
        return $articles;
    }

    /**
     * @param array $articles
     * @param array $results
     */
    private function fillResults(array $articles, array &$results): void
    {
        foreach ($articles as $article) {
            $results[] = $article;
        }
    }
}