<?php

namespace app\controllers;

use app\models\ImageUpload;

class ImageController extends Controller
{
    /**
     * Attempts to upload file
     * @return json
     */
    public function upload()
    {
        $response = [];

        if (isset($_FILES['file'])) {
            try{
                $imageData = $_FILES['file'];
                $imageUpload = new ImageUpload($imageData);

                $response = [
                    'success' => true,
                    'imageName' => $imageUpload->uploadImage(),
                ];
            } catch (\components\exceptions\ImageUploadException $e) {
                $response = [
                    'success' => false,
                    'error' => $e->getMessage()
                ];
            }
        }

        echo json_encode($response);
    }
}