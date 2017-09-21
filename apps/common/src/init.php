<?php

declare(strict_types=1);

namespace Common\Init;

function loadApp($appDir, $jsonFile) {
    $path = realpath($appDir . '/' . $jsonFile);
    if ($path === false) {
        throw new \RuntimeException(sprintf("File: %s/%s not found", $appDir, $jsonFile), 1);
    }
    $jsonData = file_get_contents($path);
    if ($jsonData === false) {
        throw new \RuntimeException(sprintf("File: %s can not be read", $path), 1);
    }
    $struct = json_decode($jsonData, true);
    if ($struct === null) {
        throw new \LogicException(sprintf("Invalid JSON file: %s", $path), 1);
    }
    if (!isset($struct['app_files']) || !is_array($struct['app_files'])) {
        throw new \LogicException(sprintf("Invalid section 'app_files' in file: %s", $path), 1);
    }
    if (!isset($struct['config_files']) || !is_array($struct['config_files'])) {
        throw new \LogicException(sprintf("Invalid section 'config_files' in file: %s", $path), 1);
    }
    if (!isset($struct['module_dirs']) || !is_array($struct['config_files'])) {
        throw new \LogicException(sprintf("Invalid section 'config_files' in file: %s", $path), 1);
    }
    if (!isset($struct['module_files']) || !is_array($struct['module_files'])) {
        throw new \LogicException(sprintf("Invalid section 'module_files' in file: %s", $path), 1);
    }
    $files = array_merge($struct['app_files'], $struct['config_files']);
    foreach ($files as $file) {
        require_once $appDir . '/' . $file;
    }
    foreach ($struct['module_dirs'] as $module) {
        foreach ($struct['module_files'] as $file) {
            $file = $appDir . '/' . $module . '/' . $file;
            if (file_exists($file)) {
                require_once $file;
            }
        }
    }

    return $app;
}
