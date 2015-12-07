<?php

require_once '../vendor/autoload.php';

use DBiagi\Application\Application;
use DBiagi\Application\Enviroment;

$app = new Application([
    'enviroment' => Enviroment::DEV,
    'cache_folder' => __DIR__ . '/../cache',
    'web_dir' => __DIR__,
    'config_dir' => __DIR__ . '/../config',
    'sources_dir' => __DIR__ . '/../src',
    'views_dir' => __DIR__ . '/../src/DBiagi/Resources/views'
]);

$app->run();
