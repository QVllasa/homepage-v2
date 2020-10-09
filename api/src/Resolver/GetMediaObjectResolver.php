<?php


namespace App\Resolver;


use ApiPlatform\Core\GraphQl\Resolver\QueryItemResolverInterface;
use Vich\UploaderBundle\Storage\StorageInterface;

final class GetMediaObjectResolver implements QueryItemResolverInterface
{

    /**
     * @var StorageInterface
     */
    private $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function __invoke($file, array $context)
    {
        //resolve url for file
        $file->contentUrl = $this->storage->resolveUri($file);
        return $file;
    }
}
