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
        'inlinesource' => [
            'en' => 'Inline currency sources',
            'uk' => 'Джерело валют у інлайні',
            'ru' => 'Источники валют в инлайне',
        ],
        'start' => [
            'en' => 'Main menu',
            'uk' => 'Головне меню',
            'ru' => 'Главное меню',
        ],
        'english' => [
            'en' => 'English',
            'uk' => 'English',
            'ru' => 'English',
        ],
        'ukrainian' => [
            'en' => 'Українська',
            'uk' => 'Українська',
            'ru' => 'Українська',
        ],
        'russian' => [
            'en' => 'Русский',
            'uk' => 'Русский',
            'ru' => 'Русский',
        ],
        'choice_lang' => [
            'en' => 'Choose language',
            'uk' => 'Виберіть мову',
            'ru' => 'Выберите язык',
        ],
        'language_changed' => [
            'en' => 'Language has been changed',
            'uk' => 'Мову змінено',
            'ru' => 'Язык изменен',
        ],
        'settings_text' => [
            'en' => 'Settings menu',
            'uk' => 'Меню налаштувань',
            'ru' => 'Меню настроек',
        ],
        'choice_inline' => [
            'en' => 'Select sources currency for inline requests:',
            'uk' => 'Вибрати джерело валют для інлайн запитів:',
            'ru' => 'Выбрать источники валют для инлайн запросов:',
        ],
        'Monobank' => [
            'en' => 'Monobank',
            'uk' => 'Monobank',
            'ru' => 'Monobank',
        ],
        'Minfin:megbank' => [
            'en' => 'Minfin Interbank',
            'uk' => 'Minfin межбанк',
            'ru' => 'Minfin межбанк',
        ],
        'remove_api' => [
            'en' => 'Source removed',
            'uk' => 'Джерело видалено',
            'ru' => 'Источник удален',
        ],
        'remove_api_denied' => [
            'en' => 'Can not delete last data source',
            'uk' => 'Не можна видалити останнє джерело даних',
            'ru' => 'Нельзя удалить последний источник данных',
        ],
        'add_api' => [
            'en' => 'Source added',
            'uk' => 'Джерело додано',
            'ru' => 'Источник добавлен',
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