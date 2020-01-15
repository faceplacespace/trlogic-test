<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

//use components\Database;
use components\Router;

//$db = new Database();

//$sql = 'INSERT INTO users (email, password) VALUES (:email, :password)';
//$statement = $db->prepare($sql);
//$feedback = $statement->execute([':email' => 'example@email.com', ':password' => 'qwerty']);

//var_dump($feedback);

session_start();

$router = new Router();
$router->run();