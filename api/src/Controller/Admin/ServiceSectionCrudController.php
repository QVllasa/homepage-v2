<?php

namespace App\Controller\Admin;

use App\Entity\ServiceSection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
            TextareaField::new('description'),
            ArrayField::new('keys'),
            AssociationField::new('service'),
            ImageField::new('image')->setBasePath('/images')->hideOnForm(),
            ImageField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex(),
        ];


        return $fields;
    }

}
