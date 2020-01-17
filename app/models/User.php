<?php

namespace app\models;

class User extends Model
{
    /**
     * Returns whether the user is currently logged in
     *
     * @return bool
     */
    public static function isAuth()
    {
        if (isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }

    /**
     * Check user email validity
     *
     * @param string $email
     * @return mixed
     */
    public static function checkEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Check user password validity
     *
     * @param string $password
     * @return bool
     */
    public static function checkPassword($password)
    {
        if (strlen($password) < 6) {
            return false;
        }

        return true;
    }

    /**
     * Sign in a user
     *
     * @param string $email
     */
    public function auth($email)
    {
        $_SESSION['user'] = $email;
    }

    /**
     * Creates a new user
     *
     * @param array $data
     */
    public function create(array $data)
    {
        $stmt = $this->db->prepare('INSERT INTO users (email, password, username, image) VALUES (:email, :password, :username, :file)');
        $stmt->execute([
            ':email' => $data['email'],
            ':username' => $data['username'],
            ':password' => $this->passwordHash($data['password']),
            ':file' => $data['file']
        ]);
    }


    /**
     * Generate password hash
     *
     * @param string $password
     * @return bool|string
     */
    private function passwordHash($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Checks if user already exists
     *
     * @param $email
     * @return bool
     */
    public function exists($email)
    {
        $stmt = $this->db->prepare('SELECT email FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);

        if ($stmt->rowCount()) {
            return true;
        }

        return false;
    }

    /**
     * getUserDataByEmailAddress
     *
     * @param string $email
     * @return mixed
     */
    public function getOne($email)
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    /**
     * Check users email and password correctness
     *
     * @param $email
     * @param $password
     * @return bool
     */
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
