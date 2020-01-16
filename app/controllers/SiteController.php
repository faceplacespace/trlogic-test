<?php

namespace app\controllers;

use app\models\User;

class SiteController
{
    public function index()
    {
        if (!User::isAuth()) {
            header('Location: /signin');
        }

        $user = new User();
        $user = $user->getOne($_SESSION['user']);

        include '../app/views/index.view.php';
    }
}