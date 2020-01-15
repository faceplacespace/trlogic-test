<?php

namespace components;

use PDO;

class Database extends PDO
{
    public function __construct()
    {
        try {
            $dbParams = require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.php';

            parent::__construct("{$dbParams['driver']}:host={$dbParams['host']};dbname={$dbParams['dbname']}", $dbParams['user'], $dbParams['password']);

            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}