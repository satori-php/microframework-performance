<?php

declare(strict_types=1);

namespace Common\Middleware\Response;

use Satori\Application\ApplicationInterface;
use Satori\Http\Response;

const MONTH = 60 * 60 * 24 * 30;

function init(ApplicationInterface $app, string $id, array $names)
{
    $app[$id] = function (\Generator $next) use ($app, $names) {
        $app->notify('start_response');
        $capsule = yield;
        $defaultLifetime = $app[$names['cookie_lifetime'] ?? ''] ?? MONTH;
        $defaultDomain = $app[$names['cookie_domain'] ?? ''] ?? '';
        $defaulSecure = $app[$names['cookie_secure'] ?? ''] ?? false;
        $defaulHttponly = $app[$names['cookie_httponly'] ?? ''] ?? true;
        Response\sendStatusLine('1.1', $capsule['http.status']);
        Response\sendHeaders($capsule['http.headers']);
        foreach ($capsule['cookies'] ?? [] as $name => $params) {
            $lifetime = ($params['lifetime'] ?? $defaultLifetime) + time();
            $path = $params['path'] ?? '/';
            $domain = $params['domain'] ?? $defaultDomain;
            $secure = $params['secure'] ?? $defaulSecure;
            $httponly = $params['httponly'] ?? $defaulHttponly;
            setcookie($name, $params['value'], $lifetime, $path, $domain, $secure, $httponly);
        }
        if (isset($capsule['http.body']) && $capsule['http.body']) {
            Response\sendBody($capsule['http.body']);
        }
        $app->notify('finish_response');
        $next->send($capsule);

        return $next->getReturn();
    };
}
