<?php

require_once '../vendor/autoload.php';

use Grigoros\Application;
use Grigoros\Enviroment;

$app = new Application(Enviroment::DEV, __DIR__ . '/..');

$app->run();
