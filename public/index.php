<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use components\Router;

session_start();

if(isset($_GET['lang'])) {
    $_SESSION['lang'] = trim(strip_tags($_GET['lang']));
    $date = time() + 30*24*60*60;
    setcookie('lang',trim(strip_tags($_GET['lang'])),$date);
}
else if (isset($_COOKIE['lang'])) {
    $_SESSION['lang'] = $_COOKIE['lang'];
}
else {
    $_SESSION['lang'] = 'en';
}

$router = new Router();
$router->run();