<?php

namespace app\controllers;

use app\models\User;
use components\FlashMessages;

class RegisterController
{
    public function index()
    {
        $title = 'Sign Up';

        if (User::isAuth()) {
            header('Location: /');
        }

        include '../app/views/signup.view.php';
    }

    public function register()
    {
        $user = new User();
        $errors = false;

        $email = trim(htmlspecialchars($_POST['email']));
        $password = trim(htmlspecialchars($_POST['password']));
        $passwordConfirm = trim(htmlspecialchars($_POST['passwordConfirm']));

        if (!User::checkEmail($email)) {
            $errors[] = 'Please enter a valid email address';
        } else {
            if ($user->exists($email)) {
                $errors[] = 'Email provided is already in use.';
            }
        }

        if (!User::checkPassword($password)) {
            $errors[] = 'Password must be at least 6 characters.';
        }

        if ($password !== $passwordConfirm) {
            $errors[] = 'Passwords do not match.';
        }

        if (!isset($errors)) {
            $user->create(compact('email', 'password'));
            header('Location: /');
        } else {
            FlashMessages::add($errors);
            header('Location: /signup');
        }
    }
}
