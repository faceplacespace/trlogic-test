<?php

namespace app\controllers;

use app\models\User;

class LoginController
{
    public function index()
    {
        include '../app/views/signin.view.php';
    }

    public function login()
    {
        $user = new User();

        $email = trim(htmlspecialchars($_POST['email']));
        $password = trim(htmlspecialchars($_POST['password']));

        $errors = false;

        if (strlen($password) < 3) {
            $errors[] = 'Password is too short.';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Please enter a valid email address';
        }

        if (!$user->exists($email)) {
            $errors[] = 'User does not exist';
        }

        if (!$errors) {
            $user->auth($email);
            header('Location: /profile');
        } else {
            header('Location: /signin');
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();

        header('Location: /');
    }
}