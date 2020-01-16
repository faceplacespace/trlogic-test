<?php


namespace app\controllers;

class Controller
{
    public function __construct()
    {
        $this->dict = $dict = parse_ini_file('../lang/' . $_SESSION['lang'] . '.ini');
    }
}