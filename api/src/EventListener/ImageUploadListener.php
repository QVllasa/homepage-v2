<?php


namespace App\EventListener;


use App\Entity\ProfileImage;
use Vich\UploaderBundle\Event\Event;

class ImageUploadListener
{
    public function onVichUploaderPostUpload(Event $event)
    {
        $object = $event->getObject();
        $mapping = $event->getMapping();

        if ($object instanceof ProfileImage){

            dd($object);
        }



        // do your stuff with $object and/or $mapping...
    }

    function convertImageToWebP($source, $destination, $quality=80) {
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
