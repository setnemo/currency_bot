<?php
require __DIR__ . '/vendor/autoload.php';

use CurrencyUaBot\Core\App;
use CurrencyUaBot\Core\TelegramWrapper;


App::run(__DIR__);

/* @var TelegramWrapper */
$tg = App::get('tg');

echo json_encode(['check' => true]);
$expectedTime = time() + 10 * 60;
while (true) {
    try {
        $tg->run();
    } catch (Throwable $t) {
        App::get('logger')->error( $t->getMessage(), $t->getTrace());;
    }
    if ($expectedTime <= time()) {
        die(0);
    }
}