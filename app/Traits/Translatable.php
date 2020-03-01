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
        'source' => [
            'en' => '💸 Currency sources',
            'uk' => '💸 Джерело валют',
            'ru' => '💸 Источники валют',
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
            'en' => 'Select sources currencies:',
            'uk' => 'Вибрати джерело валют:',
            'ru' => 'Выбрать источники валют:',
        ],
        'Monobank' => [
            'en' => '🐈 Monobank',
            'uk' => '🐈 Monobank',
            'ru' => '🐈 Monobank',
        ],
        'Privatbank:cash' => [
            'en' => '🏪 Privatbank cash',
            'uk' => '🏪 Privatbank готівка',
            'ru' => '🏪 Privatbank наличные',
        ],
        'Privatbank:cards' => [
            'en' => '🏪 Privatbank cards',
            'uk' => '🏪 Privatbank карти',
            'ru' => '🏪 Privatbank карты',
        ],
        'NBU' => [
            'en' => '🇺🇦 National Bank',
            'uk' => '🇺🇦 Нацбанк',
            'ru' => '🇺🇦 Нацбанк',
        ],
        'Minfin:megbank' => [
            'en' => '🏦 Minfin Interbank',
            'uk' => '🏦 Minfin межбанк',
            'ru' => '🏦 Minfin межбанк',
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
        'help_source' => [
            'en' => 'Help inline',
            'uk' => 'Допомога inline',
            'ru' => 'Помощь inline',
        ],
        'help_buttons' => [
            'en' => 'Help buttons',
            'uk' => 'Допомога buttons',
            'ru' => 'Помощь buttons',
        ],
        'buttonsadd' => [
            'en' => '↩️ Add button',
            'uk' => '↩️ Додати кнопку',
            'ru' => '↩️ Добавить кнопку',
        ],
        'button_add_error' => [
            'en' => '❌ Error adding button ',
            'uk' => '❌ Помилка додавання кнопки ',
            'ru' => '❌ Ошибка добавления кнопки ',
        ],
        'buttons_description' => [
            'en' => "To add a button, use the command:\n/buttonsadd EUR\nTo remove a button, use the command:\n/buttonsadd EUR\nWhere EUR is a currency code.\nYour buttons now:\n",
            'uk' => "Щоб додати кнопку, скористайтеся командою:\n/buttonsadd EUR\nЩоб видалити кнопку, скористайтеся командою:\n/buttonsdel EUR\nДе EUR це код валюти.\nВаши кнопки зараз:\n",
            'ru' => "Чтобы добавить кнопку, используйте команду:\n/buttonsadd EUR\nЧтобы удалить кнопку, используйте команду:\n/buttonsadd EUR\nГде EUR это код валюты.\nВаши кнопки сейчас:\n",
        ],
        'button_add_success' => [
            'en' => '✅ Button added',
            'uk' => '✅ Кнопка додана',
            'ru' => '✅ Кнопка добавлена',
        ],
        'buttonsremove' => [
            'en' => '↪️ Remove button',
            'uk' => '↪️ Видалити кнопку',
            'ru' => '↪️ Удалить кнопку',
        ],
        'buttonsreset' => [
            'en' => '🔄 Reset buttons',
            'uk' => '🔄 Скинути кнопки',
            'ru' => '🔄 Сбросить кнопки',
        ],
        'example' => [
            'en' => 'Example',
            'uk' => 'Приклад',
            'ru' => 'Пример',
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