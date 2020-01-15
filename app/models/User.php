<?php

namespace app\models;

use components\Database;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function create(array $data)
    {
        $stmt = $this->db->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
        $stmt->execute([
            ':email' => $data['email'],
            ':password' => $data['password']
        ]);
    }

    public function exists($email)
    {
        $stmt = $this->db->prepare('SELECT email FROM users WHERE email = :email');
        $stmt->execute(array(':email' => $email));

        if ($stmt->rowCount()) {
            return true;
        }

        return false;
    }
}
