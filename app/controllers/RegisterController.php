<?php

namespace app\controllers;

use app\models\User;

class RegisterController
{
    public function index()
    {
        if (User::isAuth()) {
            header('Location: /');
        }

        include '../app/views/signup.view.php';
    }

    public function register()
    {
        $user = new User();

        $email = trim(htmlspecialchars($_POST['email']));
        $password = trim(htmlspecialchars($_POST['password']));
        $passwordConfirm = trim(htmlspecialchars($_POST['passwordConfirm']));

        if (!User::checkPassword($password)) {
            $errors[] = 'Password must be at least 6 characters.';
        }

        if ($password != $passwordConfirm) {
            $errors[] = 'Passwords do not match.';
        }

        if (!User::checkEmail($email)) {
            $errors[] = 'Please enter a valid email address';
        } else {
            if ($user->exists($email)) {
                $errors[] = 'Email provided is already in use.';
            }
        }

        if (!isset($error)) {
            $user->create(compact('email', 'password'));
            header('Location: /');
        } else {
            include '../app/views/signin.view.php';
        }
    }
}
