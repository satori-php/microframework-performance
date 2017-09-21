<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';
$app = \Common\Init\loadApp(__DIR__ . '/../apps/site', 'init.json');

$app->run('webEngine');
