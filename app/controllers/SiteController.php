<?php

namespace app\controllers;

class SiteController
{
    public function actionIndex() {
        include 'app/views/index.view.php';
    }
}