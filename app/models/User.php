<?php

namespace app\models;

use components\Database;

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

    public function create(array $data)
    {
        $stmt = $this->db->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
        $stmt->execute([
            ':email' => $data['email'],
            ':password' => $this->passwordHash($data['password'])
        ]);
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

    public function passwordHash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}
