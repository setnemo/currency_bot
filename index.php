<?php

use CurrencyUaBot\Core\App;

require __DIR__ . '/vendor/autoload.php';

App::run(__DIR__);

echo json_encode(['check' => true]);
