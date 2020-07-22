<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use CurrencyUaBot\Core\App;
use CurrencyUaBot\Currency\Api\Factory\CurrencyContentStaticFactory;
use CurrencyUaBot\Currency\CurrencyEntity;
use CurrencyUaBot\Message\MessageCreator;
use CurrencyUaBot\Traits\ConfigAvailable;
use CurrencyUaBot\Traits\Translatable;
use Exception;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\TelegramLog;
use ReflectionException;

/**
 * Start command
 *
 * Gets executed when a user first starts using the bot.
 */
class CurrencyCommand extends UserCommand
{
    use ConfigAvailable, Translatable;
    /**
     * @var string
     */
    protected $name = 'Currency';
    /**
     * @var string
     */
    protected $description = 'Currency command';
    /**
     * @var string
     */
    protected $usage = '<currency>';
    /**
     * @var string
     */
    protected $version = '2.0.0';
    /**
     * @var bool
     */
    protected $private_only = true;

    /**
     * Command execute method
     *
     * @return ServerResponse
     * @throws TelegramException
     * @throws ReflectionException
     */
    public function execute()
    {
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();
        $text = $string = strtoupper($message->getText());
        $query = explode(' ', $string)[1] ?? null;
        if ($query) {
            if (is_numeric(explode(' ', $string)[0])) {
                $text = explode(' ', $string)[1];
                $query = explode(' ', $string)[0];
            }
            if (is_numeric(explode(' ', $string)[1])) {
                $text = explode(' ', $string)[0];
                $query = explode(' ', $string)[1];
            }
        } else {
            $query = 1;
        }
        $config = $this->getConfigFromDb($this->getMessage()->getFrom()->getId(), null);
        $lang = $config['lang'] ?? 'en';
        $inline = json_decode($config['inline'], true);
        $case = $inline['available_api'];
        $text = $this->getArticles($case, $text, $lang, $query);
        $data = [
            'chat_id' => $chat_id,
            'text' => $text . $this->t('donat', $lang),
            'parse_mode' => 'html',
            'disable_web_page_preview' => true,
        ];
        return Request::sendMessage($data);
    }

    private function getArticles(array $case, string $curr, string $lang, string $query = null): string
    {
        $text = '';
        foreach ($case as $type) {
            try {
                $entity = CurrencyContentStaticFactory::factory($type)->getCurrency(strtolower($curr));
                $text .= $this->fillText($curr, $entity, $lang, $query) . PHP_EOL . PHP_EOL;
            } catch (Exception $e) {
                TelegramLog::notice($e->getMessage());
                continue;
            }
        }
        return $text;
    }

    private function fillText(string $currency, CurrencyEntity $entity, string $lang, string $query = null): string
    {
        $pre = ' ' . strtoupper($currency) . PHP_EOL;
        /** @TODO Need refactor */
        $source = $this->t($entity->getSource(), $lang);
        if ($query) {
            $mb2 = "{$source}, " . $this->t('sell', $lang) . $pre;
            $desc2 = MessageCreator::createMultiplyMessage($query, strtoupper($currency), 'UAH', $entity->getBuy());
//        $mb1 = "{$entity->$this->getSource()}, продать" . $pre;
//        $desc1 = MessageCreator::createDivisionMessage($query, 'UAH', strtoupper($currency), $entity->getBuy($currency));
//        $mb3 = "{$entity->$this->getSource()}, купить" . $pre;
//        $desc3 = MessageCreator::createDivisionMessage($query, 'UAH', strtoupper($currency), $entity->getSale($currency));
            $mb4 = "{$source}, " . $this->t('buy', $lang) . $pre;
            $desc4 = MessageCreator::createMultiplyMessage($query, strtoupper($currency), 'UAH', $entity->getSale());
        } else {
            $mb2 = "{$source}, " . $this->t('sell', $lang). $pre;
            $desc2 = $entity->getBuy();
//        $mb1 = "{$entity->$this->getSource()}, " . $this->t('sell', $lang). $pre;
//        $desc1 = MessageCreator::createDivisionMessage($query, 'UAH', strtoupper($currency), $entity->getBuy($currency));
//        $mb3 = "{$entity->$this->getSource()}, купить" . $pre;
//        $desc3 = MessageCreator::createDivisionMessage($query, 'UAH', strtoupper($currency), $entity->getSale($currency));
            $mb4 = "{$source}, " . $this->t('buy', $lang). $pre;
            $desc4 = $entity->getSale();
        }
        return "$mb2 <b>$desc2</b>\n$mb4 <b>$desc4</b>";
    }
}
