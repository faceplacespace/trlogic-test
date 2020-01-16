<?php

namespace app\controllers;

use app\models\User;

class RegisterController
{
    public function index()
    {
        include '../app/views/signup.view.php';
    }

    public function register()
    {
        $user = new User();

        $email = trim(htmlspecialchars($_POST['email']));
        $password = trim(htmlspecialchars($_POST['password']));
        $passwordConfirm = trim(htmlspecialchars($_POST['passwordConfirm']));

        $errors = false;

        if (strlen($password) < 7) {
            $errors[] = 'Password is too short.';
        }

        if ($password != $passwordConfirm) {
            $errors[] = 'Passwords do not match.';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address';
        } else {
            if ($user->exists($email)) {
                $errors[] = 'Email provided is already in use.';
            }
        }

        if (!isset($error)) {
            $user->create(compact('email','password'));
        } else {
            include '../app/views/index.view.php';
        }
    }
}
