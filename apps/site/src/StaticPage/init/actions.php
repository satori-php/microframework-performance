<?php

declare(strict_types=1);

namespace Site\StaticPage;

use Satori\Micro\Application;
use Satori\Middleware\Capsule;
use Satori\Http\Response;

$app->errorAction = function (Application $app) {
    $render = ($app->generalRenderer)($app->errorTemplate);

    return function (Capsule $capsule) use ($render) {
        if (isset($capsule['error.code'])) {
            $code = $capsule['error.code'];
            $capsule['http.status'] = array_key_exists($code, Response\REASON_PHRASE) ? $code : 500;
        }
        $status = $capsule['http.status'];
        $capsule['http.body'] = $render([
            'http_status' => $status,
            'reason_phrase' => Response\REASON_PHRASE[$status],
            'error_message' => $capsule['error.message'] ?? null,
            'exception' => $capsule['exception'] ?? null,
        ] + $capsule['data']);

        return $capsule;
    };
};

$app->homeAction = function (Application $app) {
    $render = ($app->generalRenderer)($app->homeTemplate);

    return function (Capsule $capsule) use ($render) {
        $capsule['http.body'] = $render($capsule['data']);

        return $capsule;
    };
};
