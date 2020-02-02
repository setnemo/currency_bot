<?php

namespace CurrencyUaBot\Traits;

trait Translatable
{
    protected $translate = [
        'settings' => [
            'en' => 'Settings',
            'uk' => 'Налаштування',
            'ru' => 'Настройки',
        ],
        'language' => [
            'en' => 'Language',
            'uk' => 'Мова',
            'ru' => 'Язык',
        ],
    ];

    /**
     * @param string $word
     * @param string $lang
     * @return string
     */
    public function translate(string $word, string $lang): string
    {
        if (!empty(self::$translate[$word])) {
            return self::$translate[$word][$lang];
        }
    }
}