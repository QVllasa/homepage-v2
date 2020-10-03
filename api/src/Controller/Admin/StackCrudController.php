<?php

namespace App\Controller\Admin;

use App\Entity\Stack;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichFileType;

class StackCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Stack::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextField::new('title'),
            TextField::new('url')
        ];

        if ($pageName === Crud::PAGE_EDIT || $pageName === Crud::PAGE_NEW ){
            $fields []  = ImageField::new('logoFile')->setFormType(VichFileType::class);
        } else{
            $fields []  = ImageField::new('logo')->setBasePath('/images/logos');
        }

        return $fields;
    }
}
