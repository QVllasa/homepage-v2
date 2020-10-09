<?php

namespace App\Controller\Admin;

use App\Entity\MediaObject;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class MediaObjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MediaObject::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('filePath')->setBasePath('/media')->hideOnForm(),
            ImageField::new('file')->setFormType(VichImageType::class)->hideOnIndex()
        ];
    }

}
