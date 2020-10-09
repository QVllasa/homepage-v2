<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }


    public function configureFields(string $pageName): iterable
    {

        $fields = [
            TextField::new('title'),
            TextareaField::new('description'),
            AssociationField::new('category'),
            AssociationField::new('client'),
            ArrayField::new('keys'),
            ImageField::new('image')->setBasePath('/images')->hideOnForm(),
            ImageField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex(),
            ImageField::new('thumbnailFile')->setFormType(VichFileType::class)->hideOnIndex(),
            ImageField::new('thumbnail')->setBasePath('/images/thumbnails')->hideOnForm()
        ];

        return $fields;
    }

}
