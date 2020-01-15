<?php

namespace app\controllers;

use app\models\User;

class RegisterController
{
    public function index()
    {
        include '../app/views/index.view.php';
    }

    public function register()
    {
        $user = new User();

        $email = trim(htmlspecialchars($_POST['email']));
        $password = trim(htmlspecialchars($_POST['password']));
        $passwordConfirm = trim(htmlspecialchars($_POST['passwordConfirm']));

        if (strlen($password) < 7) {
            $error[] = 'Password is too short.';
        }

        if ($password != $passwordConfirm) {
            $error[] = 'Passwords do not match.';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error[] = 'Please enter a valid email address';
        } else {
            if ($user->exists($email)) {
                $error[] = 'Email provided is already in use.';
            }
        }

        if (!isset($error)) {
            $password = password_hash($password, PASSWORD_BCRYPT);
            $user->create(compact('email','password'));
        } else {
            include '../app/views/index.view.php';
        }
    }
}
