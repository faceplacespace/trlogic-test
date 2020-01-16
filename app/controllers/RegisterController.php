<?php

namespace app\controllers;

use app\models\User;
use components\FlashMessages;

class RegisterController extends Controller
{
    public function index()
    {
        $title = $this->dict['signup'];

        if (User::isAuth()) {
            header('Location: /');
        }

        include '../app/views/signup.view.php';
    }

    public function register()
    {
        $user = new User();

        $email = trim(htmlspecialchars($_POST['email']));
        $username = trim(htmlspecialchars($_POST['username']));
        $password = trim(htmlspecialchars($_POST['password']));
        $passwordConfirm = trim(htmlspecialchars($_POST['passwordConfirm']));
        $file = trim(htmlspecialchars($_POST['file']));

        if (!User::checkEmail($email)) {
            $errors[] = $this->dict['invalid_email_msg'];
        } else {
            if ($user->exists($email)) {
                $errors[] = $this->dict['email_exist_msg'];
            }
        }

        if (!User::checkPassword($password)) {
            $errors[] = $this->dict['password_short_msg'];
        }

        if ($password !== $passwordConfirm) {
            $errors[] = $this->dict['password_confirm_msg'];
        }

        if (!isset($errors)) {
            $user->create(compact('email', 'username', 'password', 'file'));
            $user->auth($email);
            header('Location: /');
        } else {
            FlashMessages::add($errors);

            header('Location: /signup');
        }
    }
}
