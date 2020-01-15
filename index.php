<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use components\Router;

session_start();

$router = new Router();
$router->run();