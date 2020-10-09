<?php


namespace App\EventListener;


use App\Entity\ProfileImage;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Event\Event;
use WebPConvert\WebPConvert;

class ImageUploadListener
{

    /**
     * Generate Webp image format
     *
     * Uses either Imagick or imagewebp to generate webp image
     *
     * @param string $file Path to image being converted.
     * @param int $compression_quality Quality ranges from 0 (worst quality, smaller file) to 100 (best quality, biggest file).
     *
     * @return false|string Returns path to generated webp image, otherwise returns false.
     */

    function convertImageToWebP(string $file, $compression_quality = 80)
    {
        if (!file_exists($file)) {
            return false;
        }

        // If output file already exists return path
        $filename = strtolower(pathinfo($file, PATHINFO_FILENAME));
        $dir = strtolower(pathinfo($file, PATHINFO_DIRNAME));


        $output_file = $dir . '/' . $filename . '.webp';


        if (file_exists($output_file)) {
            return $output_file;
        }

        $file_type = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        if (function_exists('imagewebp')) {

            switch ($file_type) {
                case 'jpeg':
                case 'jpg':
                    $image = imagecreatefromjpeg($file);
                    break;

                case 'png':
                    $image = imagecreatefrompng($file);
                    imagepalettetotruecolor($image);
                    imagealphablending($image, true);
                    imagesavealpha($image, true);
                    break;

                case 'gif':
                    $image = imagecreatefromgif($file);
                    break;
                default:
                    return false;
            }

            // Save the image
            $result = imagewebp($image, $output_file, $compression_quality);
            if (false === $result) {
                return false;
            }

            // Free up memory
            imagedestroy($image);

            return $output_file;
        }

        return false;
    }
}
