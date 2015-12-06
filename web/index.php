<?php

require_once '../vendor/autoload.php';

use DBiagi\Application;

$app = new Application('dev');

$app->run();
