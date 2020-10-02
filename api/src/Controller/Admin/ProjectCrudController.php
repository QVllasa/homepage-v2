<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $thumbFile = ImageField::new('thumbnailFile')->setFormType(VichFileType::class);
        $thumb = ImageField::new('thumbnail')->setBasePath('/images/thumbnails');

        $imgFile = ImageField::new('imageFile')->setFormType(VichFileType::class);
        $img = ImageField::new('image')->setBasePath('/images');

        $fields = [
            TextField::new('title'),
            TextEditorField::new('description'),
            AssociationField::new('category'),
            AssociationField::new('client')
        ];

        if ($pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL){
            $fields[] = $thumb;
            $fields[] = $img;
        } else{
            $fields[] = $thumbFile;
            $fields[] = $imgFile;
        }

        return $fields;
    }

}
