<?php

namespace app\models;

use components\Database;

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}
