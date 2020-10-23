<?php


namespace App\EventSubscriber;


use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Streaming\FFMpeg;
use Streaming\Format\X264;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\Process;
use Vich\UploaderBundle\Event\Event;
use Vich\UploaderBundle\Event\Events;
use WebPConvert\Convert\Exceptions\ConversionFailedException;
use WebPConvert\WebPConvert;

class ImageToWebPSubscriber implements EventSubscriberInterface
{


    private LoggerInterface $logger;
    private string $projectRoot;

    public function __construct(LoggerInterface $logger, KernelInterface $kernel)
    {
        $this->logger = $logger;
        $this->projectRoot = $kernel->getProjectDir();

    }


    public static function getSubscribedEvents()
    {
        return [
            Events::POST_UPLOAD => ['convertImageToWebP'],
        ];
    }

    public function convertImageToWebP(Event $event)
    {

        $object = $event->getObject();
        $mapping = $event->getMapping();

        if (!$object->file) {
            return;
        }

        /** @var File $uploadedFile */
        $uploadedFile = $object->file;
        $fileExtension = strtolower(pathinfo($uploadedFile, PATHINFO_EXTENSION));
        $fileName = strtolower(pathinfo($object->file, PATHINFO_FILENAME));

        ## Check if file should be converted ##
        if ($this->check($object)){
            return;
        }



        if (($fileExtension == "jpeg" ||
            $fileExtension == "jpg" ||
            $fileExtension == "png")) {

            try {
                WebPConvert::convert($uploadedFile->getRealPath(), $uploadedFile->getPath() . '/' . $fileName . '.webp', []);
            } catch (ConversionFailedException $e) {
                sprintf($e);
            }

            $newFile = new File($object->file->getPath() . '/' . $fileName . '.webp');
            $this->saveFile($newFile, $uploadedFile, $object, $mapping);

        } elseif (($fileExtension == "mp4" || $fileExtension == "mov")) {

            $config = [
                'ffmpeg.binaries' => '/usr/bin/ffmpeg',
                'ffprobe.binaries' => '/usr/bin/ffprobe',
                'timeout' => 3600, // The timeout for the underlying process
            ];


            $ffmpeg = FFMpeg::create($config, $this->logger);



            $video = $ffmpeg->open($uploadedFile->getPathname());;
            $format = new X264();
            $format->on('progress', function ($video, $format, $percentage) {
                $this->logger->info(sprintf("\rTranscoding...(%s%%) [%s%s]", $percentage, str_repeat('#', $percentage), str_repeat('-', (100 - $percentage))));
            });
            $video->hls()
                ->setFormat($format)
                ->autoGenerateRepresentations()
                ->save($uploadedFile->getPath() . '/' . $fileName . '.m3u8');




            $newFile = new File($uploadedFile->getPath() . '/' . $fileName . '.m3u8');
            $this->saveFile($newFile, $uploadedFile, $object, $mapping);
        }

    }

    public function saveFile(File $newFile, File $uploadedFile, $object, $mapping)
    {
        $mimeType = $newFile->getMimeType();
        $filesystem = new Filesystem();
        $filesystem->remove($uploadedFile);
        $object->setFile($newFile);

        if (method_exists($object, 'setMimeType')) {
            $object->setMimeType($mimeType);
        }

        $mapping->setFile($object, $newFile);
        $mapping->setFileName($object, $object->file->getFilename());


    }

    public function check($object)
    {
        if (!method_exists($object, 'getConvert')) {
            return;
        } elseif (!$object->getConvert()) {
            if (method_exists($object, 'setMimeType')) {
                $mimeType = $object->file->getMimeType();
                $object->setMimeType($mimeType);
            }
            return true;
        }
    }

}
