<?php

namespace App\Controller\Admin;

use App\Entity\ProfileImage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProfileImageCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        umask(0000);
        return ProfileImage::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextField::new('title'),
            BooleanField::new('convert')->hideOnIndex(),
            TextField::new('mimeType')->hideOnForm(),
            ImageField::new('filename')->setBasePath('/media')->hideOnForm(),
            ImageField::new('file')->setFormType(VichImageType::class)->hideOnIndex(),
        ];


        return $fields;
    }


}
