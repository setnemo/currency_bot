<?php

namespace CurrencyUaBot\Traits;

use CurrencyUaBot\Core\App;

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
        'buttons' => [
            'en' => 'Buttons',
            'uk' => 'Кнопки',
            'ru' => 'Кнопки',
        ],
        'inline' => [
            'en' => 'Inline currency',
            'uk' => 'Валюти у інлайні',
            'ru' => 'Валюты в инлайне',
        ],
        'menu' => [
            'en' => 'Main menu',
            'uk' => 'Головне меню',
            'ru' => 'Главное меню',
        ],
    ];

    /**
     * Get translation by default system code
     * @param string $word
     * @param string $lang
     * @return string
     */
    public function t(string $word, string $lang): string
    {
        if (!empty($this->translate[$word])) {
            return $this->translate[$word][$lang];
        }

        return 'empty';
    }

    /**
     * Get default system code by translation
     *
     * @param string $text
     * @return string|null
     */
    public function d(string $text): ?string
    {
        foreach ($this->translate as $code => $translations) {
            if (in_array($text, $translations)) {
                return $code;
            }
        }
        return null;
    }
}