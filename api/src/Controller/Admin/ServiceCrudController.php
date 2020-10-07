<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ServiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Service::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextField::new('title'),
            TextField::new('shortText'),
            IntegerField::new('priority'),
            AssociationField::new('serviceSections'),
            TextField::new('pageTitle')
        ];

        if ($pageName === Crud::PAGE_EDIT || $pageName === Crud::PAGE_NEW ){
            $fields []  = ImageField::new('imageFile')->setFormType(VichFileType::class);
        } else{
            $fields []  = ImageField::new('image')->setBasePath('/images/logos');
        }

        return $fields;
    }

}
