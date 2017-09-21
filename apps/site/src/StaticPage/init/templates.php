<?php

declare(strict_types=1);

namespace Site\StaticPage;

use Satori\Micro\Application;

$app->errorTemplate = function (Application $app) {
    return new \Site\StaticPage\ErrorTemplate(
        $app['template.dir'],
        $app['template.params']
    );
};

$app->homeTemplate = function (Application $app) {
    return new \Site\StaticPage\HomeTemplate(
        $app['template.dir'],
        $app['template.params']
    );
};
