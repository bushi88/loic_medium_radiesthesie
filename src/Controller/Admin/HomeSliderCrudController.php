<?php

namespace App\Controller\Admin;

use App\Entity\HomeSlider;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class HomeSliderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HomeSlider::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            TextField::new('description'),
            ImageField::new('image')
                ->setBasePath('/assets/images/slider/')
                ->setUploadDir('public/assets/images/slider/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            BooleanField::new('isDisplayed')
        ];
    }
}