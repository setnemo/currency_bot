<?php

namespace CurrencyUaBot\Traits;

use CurrencyUaBot\Core\App;

trait Translatable
{
    protected $translate = [
        'settings' => [
            'en' => '⚙️ Settings',
            'uk' => '⚙️ Налаштування',
            'ru' => '⚙️ Настройки',
        ],
        'language' => [
            'en' => '💬 Language',
            'uk' => '💬 Мова',
            'ru' => '💬 Язык',
        ],
        'buttons' => [
            'en' => '📱 Buttons',
            'uk' => '📱 Кнопки',
            'ru' => '📱 Кнопки',
        ],
        'inlinesource' => [
            'en' => '💸 Inline currency sources',
            'uk' => '💸 Джерело валют у інлайні',
            'ru' => '💸 Источники валют в инлайне',
        ],
        'start' => [
            'en' => '💠 Main menu',
            'uk' => '💠 Головне меню',
            'ru' => '💠 Главное меню',
        ],
        'english' => [
            'en' => '🇬🇧 English 🇬🇧',
            'uk' => '🇬🇧 English 🇬🇧',
            'ru' => '🇬🇧 English 🇬🇧',
        ],
        'ukrainian' => [
            'en' => '🇺🇦 Українська 🇺🇦',
            'uk' => '🇺🇦 Українська 🇺🇦',
            'ru' => '🇺🇦 Українська 🇺🇦',
        ],
        'russian' => [
            'en' => '🇷🇺 Русский 🇷🇺',
            'uk' => '🇷🇺 Русский 🇷🇺',
            'ru' => '🇷🇺 Русский 🇷🇺',
        ],
        'choice_lang' => [
            'en' => '🇬🇧 Choose language',
            'uk' => '🇺🇦 Виберіть мову',
            'ru' => '🇷🇺 Выберите язык',
        ],
        'language_changed' => [
            'en' => '🇬🇧 Language has been changed',
            'uk' => '🇺🇦 Мову змінено',
            'ru' => '🇷🇺 Язык изменен',
        ],
        'settings_text' => [
            'en' => '⚙️ Settings menu',
            'uk' => '⚙️ Меню налаштувань️',
            'ru' => '⚙️ Меню настроек',
        ],
        'choice_inline' => [
            'en' => 'Select sources currency for inline requests:',
            'uk' => 'Вибрати джерело валют для інлайн запитів:',
            'ru' => 'Выбрать источники валют для инлайн запросов:',
        ],
        'Monobank' => [
            'en' => '🐈 Monobank',
            'uk' => '🐈 Monobank',
            'ru' => '🐈 Monobank',
        ],
        'Minfin:megbank' => [
            'en' => 'Minfin Interbank',
            'uk' => 'Minfin межбанк',
            'ru' => 'Minfin межбанк',
        ],
        'remove_api' => [
            'en' => '💔 Source removed',
            'uk' => '💔 Джерело видалено',
            'ru' => '💔 Источник удален',
        ],
        'remove_api_denied' => [
            'en' => '❌ Can not delete last data source',
            'uk' => '❌ Не можна видалити останнє джерело даних',
            'ru' => '❌ Нельзя удалить последний источник данных',
        ],
        'add_api' => [
            'en' => '✅ Source added',
            'uk' => '✅ Джерело додано',
            'ru' => '✅ Источник добавлен',
        ],
        'help' => [
            'en' => '💭 Help',
            'uk' => '💭 Допомога',
            'ru' => '💭 Помощь',
        ],
        'help_functionality' => [
            'en' => 'Help functionality',
            'uk' => 'Допомога functionality',
            'ru' => 'Помощь functionality',
        ],
        'help_inlinesource' => [
            'en' => 'Help inline',
            'uk' => 'Допомога inline',
            'ru' => 'Помощь inline',
        ],
        'help_buttons' => [
            'en' => 'Help buttons',
            'uk' => 'Допомога buttons',
            'ru' => 'Помощь buttons',
        ],
        'buttons_add' => [
            'en' => '↩️ Add button',
            'uk' => '↩️ Додати кнопку',
            'ru' => '↩️ Добавить кнопку',
        ],
        'buttons_remove' => [
            'en' => '↪️ Remove button',
            'uk' => '↪️ Видалити кнопку',
            'ru' => '↪️ Удалить кнопку',
        ],
        'buttons_reset' => [
            'en' => '🔄 Reset buttons',
            'uk' => '🔄 Скинути кнопки',
            'ru' => '🔄 Сбросить кнопки',
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