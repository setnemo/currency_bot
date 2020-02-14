<?php

namespace CurrencyUaBot\Core;

use CurrencyUaBot\Currency\Api\Factory\CurrencyContentStaticFactory;
use Slim\PDO\Database;

class DbRepository
{
    /**
     * @var Database
     */
    private $connection;

    public function __construct(Database $database)
    {
        $this->connection = $database;
    }

    /**
     * @param int $id
     * @param string|null $lang
     * @return array
     */
    public function getConfigByIdOrCreate(int $id, ?string $lang): array
    {
        $selectStatement = $this->connection->select([
            'user_id', 'lang', 'buttons', 'inline'
        ])
            ->from('user_config')
            ->where('user_id', '=', $id);
        $stmt = $selectStatement->execute();
        $result = $stmt->fetchAll();

        if (0 === $stmt->rowCount()) {
            $result = $this->insertNewConfig($id, $lang);
        }

        return $result[0];
    }

    /**
     * @param int $id
     * @param string $lang
     */
    public function updateLanguageCode(int $id, string $lang)
    {
        $updateStatement = $this->connection->update(['lang' => $lang])
            ->table('user_config')
            ->where('user_id', '=', $id);
        $affectedRows = $updateStatement->execute();
    }

    /**
     * @param int $id
     * @param string|null $lang
     * @return array
     */
    private function insertNewConfig(int $id, ?string $lang): array
    {
        if (!$lang || $lang === 'null') {
            $lang = 'en';
        }
        /** @TODO Save percent for sale-tax */
        $result = [
            $id,
            $lang,
            \GuzzleHttp\json_encode(['USD', 'EUR']),
            \GuzzleHttp\json_encode([
                'defaultCurrency' => 'usd',
                'available_api' => [
                    CurrencyContentStaticFactory::MONOBANK,
                    CurrencyContentStaticFactory::MINFIN_MB,
                ],
                'tax' => 0,
            ]),
        ];
        $insertStatement = $this->connection->insert(['user_id', 'lang', 'buttons', 'inline'])
            ->into('user_config')
            ->values($result);
        $insertStatement->execute(false);

        return [$result];
    }

    /**
     * @param int $id
     * @param array $apis
     */
    public function updateApiFromConfig(int $id, array $apis)
    {
        $selectStatement = $this->connection->select(['inline'])
            ->from('user_config')
            ->where('user_id', '=', $id);
        $stmt = $selectStatement->execute();
        $fetch = $stmt->fetchAll();

        $result = $fetch[0] ?? [];
        $newDataString = $result['inline'] ?? '{}';
        $newData = json_decode($newDataString, true);
        $newData['available_api'] = $apis;
        $updateStatement = $this->connection->update(['inline' => \GuzzleHttp\json_encode($newData)])
            ->table('user_config')
            ->where('user_id', '=', $id);
        $affectedRows = $updateStatement->execute();
    }
}