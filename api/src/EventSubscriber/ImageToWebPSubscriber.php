<?php


namespace App\EventSubscriber;

use App\Entity\ProfileImage;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Event\Event;
use Vich\UploaderBundle\Event\Events;
use WebPConvert\WebPConvert;

class ImageToWebPSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            Events::POST_UPLOAD => ['convertImageToWebP'],
        ];
    }

    public function convertImageToWebP(Event $event)
    {

        /** @var ProfileImage $object */
        $object = $event->getObject();

        if (!$object instanceof ProfileImage){
            return;
        }

        $oldFile = $object->imageFile;
        $fileName = strtolower(pathinfo($object->imageFile, PATHINFO_FILENAME));
        $mapping = $event->getMapping();

        WebPConvert::convert($object->imageFile->getRealPath(), $object->imageFile->getPath().'/'.$fileName. '.webp', []);

        $newFile = new File($object->imageFile->getPath().'/'.$fileName. '.webp');

        $filesystem = new Filesystem();
        $filesystem->remove($oldFile);

        $object->imageFile = $newFile;

        $mapping->setFile($object, $newFile);
        $mapping->setFileName($object, $object->imageFile->getFilename());
    }


}
