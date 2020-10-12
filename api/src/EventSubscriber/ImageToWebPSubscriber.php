<?php


namespace App\EventSubscriber;


use Streaming\FFMpeg;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Event\Event;
use Vich\UploaderBundle\Event\Events;
use WebPConvert\Convert\Exceptions\ConversionFailedException;
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
        ini_set("memory_limit", -1);

        $object = $event->getObject();
        $entityType = get_class($object);

        if (!$object instanceof $entityType) {
            return;
        }

        if (!$object->file) {
            return;
        }





        /** @var File $uploadedFile */
        $uploadedFile = $object->file;
        $fileExtension = strtolower(pathinfo($uploadedFile, PATHINFO_EXTENSION));
        $fileName = strtolower(pathinfo($object->file, PATHINFO_FILENAME));

        if (!method_exists($object, 'getConvert')){
            return;
        } elseif (!$object->getConvert()){
            if (method_exists($object, 'setMimeType')){
                $mimeType = $object->file->getMimeType();
                $object->setMimeType($mimeType);
            }
            return;
        }

        if (($fileExtension == "jpeg" ||
            $fileExtension == "jpg" ||
            $fileExtension == "png")) {

            $mapping = $event->getMapping();
            try {
                WebPConvert::convert($uploadedFile->getRealPath(), $uploadedFile->getPath() . '/' . $fileName . '.webp', []);
            } catch (ConversionFailedException $e) {
                sprintf($e);
            }
            $newFile = new File($object->file->getPath() . '/' . $fileName . '.webp');
            $mimeType = $newFile->getMimeType();
            $filesystem = new Filesystem();
            $filesystem->remove($uploadedFile);
            $object->setFile($newFile);

            if (method_exists($object, 'setMimeType')){
                $object->setMimeType($mimeType);
            }

            $mapping->setFile($object, $newFile);
            $mapping->setFileName($object, $object->file->getFilename());

        } elseif (($fileExtension == "mp4" || $fileExtension == "mov")) {
            return;
//            $log = new Logger('FFmpeg_Streaming');
//            $log->pushHandler(new StreamHandler('/var/log/ffmpeg-streaming.log')); // path to log file

//            $config = [
//                'ffmpeg.binaries' => '/usr/bin/ffmpeg',
//                'ffprobe.binaries' => '/usr/bin/ffprobe',
//                'timeout' => 0, // The timeout for the underlying process
//                'ffmpeg.threads' => 1,   // The number of threads that FFmpeg should use
//            ];
//
//
//            $ffmpeg = FFMpeg::create($config);
//
//            $video = $ffmpeg->open($uploadedFile->getPathname() );
//            $video->hls()
//                ->x264()
//                ->autoGenerateRepresentations()
//                ->save();
        }


    }


}
