<?php

declare(strict_types=1);

namespace Site\App;

use Satori\Micro\Application;
use Satori\Middleware;

$app = new Application();

Middleware\FastRoute\init($app, 'middleware.fast_route', ['router' => 'router']);
Middleware\Action\init($app, 'middleware.action', ['error_action' => 'errorAction']);

\Common\Middleware\Response\init($app, 'middleware.response', [
    'cookie_lifetime' => 'cookie.lifetime',
    'cookie_domain' => 'domain.admin',
    'cookie_secure' => 'cookie.secure',
    'cookie_httponly' => 'cookie.httponly',
]);

$app->router = function (Application $app) {
    if (isset($app['route.cache_file'])) {
        return \FastRoute\cachedDispatcher($app['route.list'], [
            'cacheFile' => $app['route.cache_file'],
            'cacheDisabled' => $app['route.cache_disabled'] ?? false,
        ]);
    }

    return \FastRoute\simpleDispatcher($app['route.list']);
};

$app['route.list'] = function (\FastRoute\RouteCollector $routes) {
    $routes->addRoute('GET', '/', 'homeAction');
};

$app->webEngine = function (Application $app) {
    $next = Middleware\turnBack();
    $next = $app['middleware.response']($next);
    $next = $app['middleware.action']($next);
    $pipeline = $app['middleware.fast_route']($next);

    $capsule = new Middleware\Capsule();
    $pipeline->send($capsule);
    $capsule = $pipeline->getReturn();

    return $capsule;
};
