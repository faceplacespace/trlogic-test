<?php

namespace app\controllers;

use app\models\User;

class LoginController
{
    public function index()
    {
        if (User::isAuth()) {
            header('Location: /');
        }

        include '../app/views/signin.view.php';
    }

    public function login()
    {
        $user = new User();

        $email = trim(htmlspecialchars($_POST['email']));
        $password = trim(htmlspecialchars($_POST['password']));

        if (!User::checkPassword($password)) {
            $errors[] = 'Password is too short.';
        }

        if (!User::checkEmail($email)) {
            $errors[] = 'Please enter a valid email address';
        }

        if (!$user->exists($email)) {
            $errors[] = 'User does not exist';
        }

        if (!$errors) {
            $user->auth($email);
            header('Location: /');
        } else {
            header('Location: /signin');
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();

        header('Location: /signin');
    }
}