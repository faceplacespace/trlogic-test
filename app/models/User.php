<?php

namespace app\models;

class User extends Model
{
    public static function auth($email)
    {
        $_SESSION['user'] = $email;
    }

    public static function isAuth()
    {
        if (isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }

    public static function checkEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function checkPassword($password)
    {
        if (strlen($password) < 6) {
            return false;
        }

        return true;
    }

    public function create(array $data)
    {
        $stmt = $this->db->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
        $stmt->execute([
            ':email' => $data['email'],
            ':password' => $this->passwordHash($data['password'])
        ]);
    }

    private function passwordHash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function exists($email)
    {
        $stmt = $this->db->prepare('SELECT email FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);

        if ($stmt->rowCount()) {
            return true;
        }

        return false;
    }

    public function getOne($email)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    public function check($email, $password)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email AND password = :password');
        $stmt->execute([
            ':email' => $email,
            ':password' => $this->passwordHash($password)
        ]);

        if ($stmt->rowCount()) {
            return true;
        }

        return false;
    }
}
