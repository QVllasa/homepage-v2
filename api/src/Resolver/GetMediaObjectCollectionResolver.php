<?php


namespace App\Resolver;


use ApiPlatform\Core\GraphQl\Resolver\QueryCollectionResolverInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Vich\UploaderBundle\Storage\StorageInterface;


final class GetMediaObjectCollectionResolver implements QueryCollectionResolverInterface
{


    /**
     * @var StorageInterface
     */
    private StorageInterface $storage;


    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function __invoke(iterable $collection, array $context): iterable
    {
        foreach ($collection as $file) {
            // resolve url for each item
            $file->contentUrl = $this->storage->resolveUri($file);
        }
        return $collection;
    }
}
