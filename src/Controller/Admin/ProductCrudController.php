<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }


    public function configureFields(string $pageName): iterable
    {
        if ($this->getUser()) {
            //dump($this->getUser()->getEmail());
            //dump($this->getUser()->getId());
            return [
                TextField::new('name'),
                SlugField::new('slug')->setTargetFieldName('name'),
                ImageField::new('illustration')
                    ->setBasePath('uploads/')
                    ->setUploadDir('/public/uploads')
                    ->setFormTypeOptions(['required' => false])
                    ->setUploadedFileNamePattern('[contenthash].[extension]'),
                TextField::new('subtitle'),
                TextareaField::new('description'),
                MoneyField::new('price')->setCurrency('TND'),
                AssociationField::new('category'),
                HiddenField::new('contributor')->setFormTypeOptions(['data' => $this->getUser()->getEmail()])

            ];
        } else {
            return [
                TextField::new('name'),
                SlugField::new('slug')->setTargetFieldName('name'),
                ImageField::new('illustration')
                    ->setBasePath('uploads/')
                    ->setUploadDir('/public/uploads')
                    ->setFormTypeOptions(['required' => false])
                    ->setUploadedFileNamePattern('[contenthash].[extension]'),
                TextField::new('subtitle'),
                TextareaField::new('description'),
                MoneyField::new('price')->setCurrency('TND'),
                AssociationField::new('category'),
                HiddenField::new('contributor')->setFormTypeOptions(['data' => 'admin'])


            ];
        }
    }
}
