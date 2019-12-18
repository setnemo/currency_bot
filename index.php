<?php

use GuzzleHttp\Client;
use Monolog\Logger;

require __DIR__ . '/vendor/autoload.php';
$env = Dotenv\Dotenv::createImmutable(__DIR__);
$env->load();
$commands_paths = [
    __DIR__ . '/app/Commands/',
];

$token  = getenv('TG_TOKEN');
$botName  = getenv('TG_BOT_NAME');
$mysql_credentials = [
    'host'     => getenv('DB_HOST'),
    'port'     => getenv('DB_PORT'),
    'user'     => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'database' => getenv('DB_NAME'),
];

try {
    $logger = new Monolog\Logger('bot');
    $logger->pushHandler(new  Monolog\Handler\StreamHandler(__DIR__.'/logs/app.log', Logger::ERROR));
    $logger->pushHandler(new  Monolog\Handler\StreamHandler(__DIR__.'/logs/debug.log', Logger::DEBUG));
    $telegram = new Longman\TelegramBot\Telegram($token, $botName);
    $hookRegistrator = new USD2UAH\BotRegistrator($telegram, $logger);
    $hookRegistrator->register();
    Longman\TelegramBot\TelegramLog::initialize($logger);
    $telegram->enableAdmin(intval(getenv('ADMIN')));
    $telegram->addCommandsPaths($commands_paths);
    $telegram->enableMySql($mysql_credentials);
    $telegram->enableLimiter();
    $telegram->handle();

}  catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // Log telegram errors
    Longman\TelegramBot\TelegramLog::error($e);
} catch (Longman\TelegramBot\Exception\TelegramLogException $e) {
    // Catch log initialisation errors
    $logger->error($e->getMessage());
} catch (Exception $e) {
    $logger->error($e->getMessage());
}

echo json_encode(['check' => true]);
