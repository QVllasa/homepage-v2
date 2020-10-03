<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichFileType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }



    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextField::new('firstName'),
            TextField::new('lastName'),
            TextField::new('email'),

        ];

        if ($pageName === Crud::PAGE_EDIT || $pageName === Crud::PAGE_NEW ){
            $fields[] = TextField::new('password');
            $fields []  = ImageField::new('avatarFile')->setFormType(VichFileType::class);
        } else{
            $fields []  = ImageField::new('avatar')->setBasePath('/images/avatars');
        }

        return $fields;
    }

}
