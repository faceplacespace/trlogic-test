<?php

namespace app\controllers;

use app\models\User;

class SiteController extends Controller
{
    /**
     * Displaying user profile
     */
    public function index()
    {
        $title = $this->dict['profile'];;

        if (!User::isAuth()) {
            header('Location: /signin');
        }

        $user = new User();
        $user = $user->getOne($_SESSION['user']);

        include '../app/views/index.view.php';
    }
}