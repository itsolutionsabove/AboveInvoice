<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Imagick;

class FileUploadService
{
    public static string $uploadsDir = 'app/';
    /**
     * Upload a file to the specified folder with optional WebP conversion.
     *
     * @param \Illuminate\Http\UploadedFile $file The uploaded file.
     * @param string $folder The folder where the file will be stored.
     * @param string $prefix The prefix to be added to the filename (optional).
     * @param bool $convertToWebP Whether to convert the image to WebP format (default is true).
     * @return string The filename of the uploaded or converted file.
     */
    public static function upload(UploadedFile $file, string $folder, string $prefix = '', bool $convertToWebP = true): string
    {
        // Generate a unique filename with the provided prefix
        $filename = uniqid('green_' . $prefix) . '.' . $file->getClientOriginalExtension();

        // Check if conversion to WebP is enabled and the file extension is supported
        if ($convertToWebP && in_array(strtolower($file->getClientOriginalExtension()), ['jpeg', 'jpg', 'png'])) {
            $webpFilename = uniqid('green_' . $prefix) . '.webp';
            self::convertToWebP($file->getRealPath(), $folder, $webpFilename);
            $filename = $webpFilename;
        } else {
            // Store the file in the specified folder
            $file->storeAs($folder, $filename, 'public');
        }

        return $filename;
    }

    /**
     * Convert an image to WebP format and save it in the specified folder.
     *
     * @param string $imagePath The path of the source image.
     * @param string $folder The folder where the WebP image will be stored.
     * @param string $webpFilename The filename for the WebP image.
     */
    private static function convertToWebP(string $imagePath, string $folder, string $webpFilename): void
    {
        // Check if the folder exists, if not, create it
        $folderPath = storage_path(self::$uploadsDir . $folder);
        self::createFolderIfNotExist($folderPath);

        // Create an image resource from the source image
        $image = imagecreatefromstring(file_get_contents($imagePath));
        imagepalettetotruecolor($image);
        if ($image !== false) {
            // Generate the path for the WebP image
            $webpPath = $folderPath . '/' . $webpFilename;
            // Convert and save the image as WebP
            imagewebp($image, $webpPath);

            // Destroy the image resource
            imagedestroy($image);
        }
    }

    /**
     * Create a folder if it does not exist.
     *
     * @param string $folder The folder path.
     */
    private static function createFolderIfNotExist($folder)
    {
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true); // Recursive directory creation with full permissions (you may adjust permissions based on your requirements)
        }
    }

    public static function delete(string $filePath) : bool|string
    {
        $filePath = realpath(storage_path(self::$uploadsDir . $filePath));
        if(!file_exists($filePath)) return "file not exists";
        if(!unlink($filePath)) return "can't delete file";
        return true;
    }
}
