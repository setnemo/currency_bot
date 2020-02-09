<?php

namespace CurrencyUaBot\Traits;

use Predis\Client;
use CurrencyUaBot\Core\App;

trait Cacheable
{
    /**
     * @throws \Exception
     */
    public function cache(): Client
    {
        return App::get('redis');
    }

    /**
     * @param string $source
     * @param string|null $customClassName
     * @return string
     * @throws \ReflectionException
     */
    public function getCacheSlug(string $source, string $customClassName = null)
    {
        return $this->getShortName($customClassName) . '::' . $source;
    }

    /**
     * @param string|null $name
     * @return string
     * @throws \ReflectionException
     */
    public function getShortName(string $name = null): string
    {
        return $name ? $name : (new \ReflectionClass($this))->getShortName();
    }

    /**
     * @param int $userId
     * @param int|null $chatId
     * @return array
     * @throws \Exception
     */
    public function dataForLanguageUpdateCommand(int $userId, int $chatId = null): array
    {
        $key = "update_lang_{$userId}";
        if (!$this->cache()->exists($key)) {
            $this->cache()->set($key, $chatId, 'EX', 300);
        } else {
            $chatId = $this->cache()->get($key);
        }
        return ['userId' => $userId, 'chatId' => $chatId];
    }
}