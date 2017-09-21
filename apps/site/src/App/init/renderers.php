<?php

declare(strict_types=1);

namespace Site\App;

use Satori\Micro\Application;
use Satori\Template\AbstractTemplate;

$app->generalRenderer = function (Application $app) {
    $getRendererData = $app->generalRendererService;

    return function (AbstractTemplate $template) use ($getRendererData) {
        return function (array $data) use ($template, $getRendererData) {
            return $template->render($data + $getRendererData());
        };
    };
};

$app->generalRendererService = function (Application $app) {
    $getSomething = null;

    return function () use ($getSomething) {
        return [];
    };
};
