<?php

namespace app\models;

use components\exceptions\ImageUploadException;

class ImageUpload
{
    const UPLOAD_DIR = '../uploads/';
    const MAX_IMAGE_SIZE = 5000000;
    const ALLOWED_TYPES = [IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF];

    public $image = [];

    public function __construct(array $imageData)
    {
        $this->image = $imageData;
    }

    /**
     * Store uploaded image
     *
     * @return string
     * @throws ImageUploadException
     */
    public function uploadImage()
    {
        $this->validate();

        $fileName = $this->generateFileName();

        if (!is_dir(self::UPLOAD_DIR)) {
            mkdir(self::UPLOAD_DIR, 0777, true);
        }

        if (!$this->saveImage($fileName)) {
            throw new ImageUploadException('Failed to move uploaded file.');
        }

        return self::UPLOAD_DIR . $fileName;
    }

    /**
     * Validate image
     * @throws ImageUploadException
     */
    private function validate()
    {
        if (!isset($this->image['error']) || is_array($this->image['error']['error'])) {
            throw new ImageUploadException('Invalid parameters.');
        }

        switch ($this->image['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new ImageUploadException('No file sent.');
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new ImageUploadException('Exceeded filesize limit.');
            default:
                throw new ImageUploadException('Unknown errors.');
        }

        if ($this->image['size'] > self::MAX_IMAGE_SIZE) {
            throw new ImageUploadException('Exceeded filesize limit.');
        }

        if (!in_array($this->getFileType(), self::ALLOWED_TYPES)) {
            throw new ImageUploadException('Invalid file format.');
        }
    }

    private function getFileType()
    {
        return exif_imagetype($this->image['tmp_name']);
    }

    private function generateFileName()
    {
        $extension = pathinfo($this->image['name'], PATHINFO_EXTENSION);
        return strtolower(md5($this->image['name'] . time())) . '.' . $extension;
    }

    /**
     * Move uploaded image to upload directory
     * @param string $fileName
     * @return bool
     */
    private function saveImage($fileName)
    {
        return move_uploaded_file($this->image['tmp_name'], self::UPLOAD_DIR . $fileName);
    }
}