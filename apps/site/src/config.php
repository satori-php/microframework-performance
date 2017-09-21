<?php

declare(strict_types=1);

$app['template.dir'] = realpath(__DIR__ . '/../template');
$app['template.params'] = [
    'site_name' => 'Satori micro',
    'site' => $app['domain'],
];

$app['route.cache_file'] = __DIR__ . '/../cache/route.cache';
