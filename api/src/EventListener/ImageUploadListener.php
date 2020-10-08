<?php


namespace App\EventListener;


use App\Entity\ProfileImage;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Event\Event;

class ImageUploadListener
{
    public File $file;

    public function onVichUploaderPostUpload(Event $event)
    {
        $object = $event->getObject();
        $mapping = $event->getMapping();

        if ($object instanceof ProfileImage) {

            $this->file = $object->getImageFile();
            dd($this->file->getPath());


        }

        // do your stuff with $object and/or $mapping...
    }

    function convertImageToWebP($source, $destination, $quality = 80)
    {
        $extension = pathinfo($source, PATHINFO_EXTENSION);
        if ($extension == 'jpeg' || $extension == 'jpg')
            $image = imagecreatefromjpeg($source);
        elseif ($extension == 'gif')
            $image = imagecreatefromgif($source);
        elseif ($extension == 'png')
            $image = imagecreatefrompng($source);
        return imagewebp($image, $destination, $quality);

    }
}
