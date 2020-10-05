<?php

namespace App\Controller\Admin;

use App\Entity\ServiceSection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ServiceSectionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ServiceSection::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextField::new('title'),
            TextEditorField::new('description'),
            ArrayField::new('keys'),
            AssociationField::new('service'),
        ];

        if ($pageName === Crud::PAGE_EDIT || $pageName === Crud::PAGE_NEW ){
            $fields []  = ImageField::new('imageFile')->setFormType(VichFileType::class);
        } else{
            $fields []  = ImageField::new('image')->setBasePath('/images/logos');
        }

        return $fields;
    }

}
