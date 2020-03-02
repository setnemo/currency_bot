<?php

namespace CurrencyUaBot\Traits;

use CurrencyUaBot\Core\Connection;

trait ConfigAvailable
{

    /**
     * @param int $userId
     * @param string|null $lang
     * @return array
     */
    protected function getConfigFromDb(int $userId, string $lang = null): array
    {
        return Connection::getRepository()->getConfigByIdOrCreate($userId, $lang);
    }
}