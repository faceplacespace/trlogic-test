<?php

namespace app\controllers;

use app\models\ImageUpload;

class ImageController
{
    public function upload()
    {
        $response = [];

        if (isset($_FILES['file'])) {
            $imageData = $_FILES['file'];
            $imageUpload = new ImageUpload($imageData);

            $response = [
                'imageName' => $imageUpload->uploadImage(),
            ];
        }

        echo json_encode($response);
    }
}