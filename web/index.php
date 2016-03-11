<?php

error_reporting(E_ALL);
require_once '../vendor/autoload.php';

use Grigoros\Application;
use Grigoros\Enviroment;

$app = new Application(Enviroment::DEV, __DIR__ . '/..');

$app->run();
