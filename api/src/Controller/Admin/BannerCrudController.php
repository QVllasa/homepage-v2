<?php

namespace App\Controller\Admin;

use App\Entity\Banner;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichFileType;

class BannerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Banner::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextField::new('title'),
            ImageField::new('path')->setBasePath('/images')->hideOnForm(),
            ImageField::new('pathFile')->setFormType(VichFileType::class)->hideOnIndex()
        ];


        return $fields;
    }
}
