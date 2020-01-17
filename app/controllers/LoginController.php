<?php

namespace app\controllers;

use app\models\User;
use components\FlashMessages;

class LoginController extends Controller
{
    /**
     * displaying sign in form
     */
    public function index()
    {
        $title = $this->dict['signin'];;

        if (User::isAuth()) {
            header('Location: /');
        }

        include '../app/views/signin.view.php';
    }

    /**
     *  Attempts to sign in a user
     */
    public function login()
    {
        $user = new User();

        $email = trim(htmlspecialchars($_POST['email']));
        $password = trim(htmlspecialchars($_POST['password']));

        if (!User::checkPassword($password)) {
            $errors[] = $this->dict['password_short_msg'];
        }

        if (!User::checkEmail($email)) {
            $errors[] = $this->dict['invalid_email_msg'];
        }

        if (empty($errors) && !$user->exists($email)) {
            $errors[] = $this->dict['user_exist_msg'];
        }

        if (!$errors) {
            $user->auth($email);
            header('Location: /');
        } else {
            FlashMessages::add($errors);
            header('Location: /signin');
        }
    }

    /**
     * Logs the user out
     */
    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();

        header('Location: /signin');
    }
}