<?php

namespace Longman\TelegramBot\Commands\SystemCommands;

use CurrencyUaBot\Core\App;
use CurrencyUaBot\Core\Connection;
use CurrencyUaBot\Currency\Api\CurrencyContent;
use CurrencyUaBot\Currency\Api\Factory\CurrencyContentStaticFactory;
use CurrencyUaBot\Currency\CurrencyEntity;
use CurrencyUaBot\Message\InlineEntityCreator;
use CurrencyUaBot\Message\MessageCreator;
use CurrencyUaBot\Traits\Translatable;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\InlineQuery\InlineQueryResultArticle;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\TelegramLog;

/**
 * Inline query command
 *
 * Command that handles inline queries.
 */
class InlinequeryCommand extends SystemCommand
{
    use Translatable;
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
     * @throws GuzzleException
     */
    public function execute()
    {
        $inline_query = $this->getInlineQuery();
        $query = $inline_query->getQuery();
        $results = [];
        $data = [
            'inline_query_id' => $inline_query->getId(),
            'cache_time' => 0,
        ];

        if ($query !== '') {
            if (is_numeric($query) && $query > 0 || intval(substr(trim($query), 4)) > 0) {
                if ($query > 0) {
                    $currency = 'usd';
                } else {
                    $currency = trim(strtolower(substr($query, 0, 3)));
                    $query = intval(substr($query, 4));
                }
                $userId = $inline_query->getFrom()->getId();
                $config = Connection::getRepository()->getConfigByIdOrCreate($userId, null);
                $lang = $config['lang'] ?? 'en';
                $inline = json_decode($config['inline'], true);
                $case = $inline['available_api'];

                $this->fillResults($this->getArticles($case, $currency, $query, $lang), $results);
            }
        }
        $data['results'] = '[' . implode(',', $results) . ']';

        return Request::answerInlineQuery($data);
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

    /**
     * @param array $case
     * @param string $curr
     * @param string $query
     * @param string $lang
     * @return array
     * @throws GuzzleException
     */
    private function getArticles(array $case, string $curr, string $query, string $lang): array
    {
        $articles = [];
        foreach ($case as $type) {
            try {
                $entity = CurrencyContentStaticFactory::factory($type)->getCurrency($curr);
                $articles = array_merge($this->fillArticles($curr, $query, $entity, $lang), $articles);
            } catch (Exception $e) {
                TelegramLog::notice($e->getMessage());
                continue;
            }
        }
        return $articles;
    }

    /**
     * @param string $currency
     * @param string $query
     * @param CurrencyEntity $entity
     * @param string $lang
     * @return array
     * @throws Exception
     */
    private function fillArticles(string $currency, string $query, CurrencyEntity $entity, string $lang): array
    {
        $pre = ' ' . strtoupper($currency);
        /** @TODO Need refactor */
        $source = $this->t($entity->getSource(), $lang);
        $mb2 = "{$source}, продать" . $pre;
        $desc2 = MessageCreator::createMultiplyMessage($query, strtoupper($currency), 'UAH', $entity->getBuy());
//        $mb1 = "{$entity->$this->getSource()}, продать" . $pre;
//        $desc1 = MessageCreator::createDivisionMessage($query, 'UAH', strtoupper($currency), $entity->getBuy($currency));
//        $mb3 = "{$entity->$this->getSource()}, купить" . $pre;
//        $desc3 = MessageCreator::createDivisionMessage($query, 'UAH', strtoupper($currency), $entity->getSale($currency));
        $mb4 = "{$source}, купить" . $pre;
        $desc4 = MessageCreator::createMultiplyMessage($query, strtoupper($currency), 'UAH', $entity->getSale());
        return [
            $this->getFillTemplate($mb4, $desc4),
//            $this->getFillTemplate($mb3, $desc3),
            $this->getFillTemplate($mb2, $desc2),
//            $this->getFillTemplate($mb1, $desc1),
        ];
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
}