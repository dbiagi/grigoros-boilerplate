<?php
error_reporting(E_ALL); ini_set('display_errors',true); 
require_once '../vendor/autoload.php';

use Application\Application;
use Application\Enviroment;

$app = new Application(Enviroment::DEV, __DIR__ . '/..');

$app->run();
