<?php

namespace App\Controller\Admin;

use App\Entity\Cut;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class CutCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cut::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('CutValue','Taille'),
            BooleanField::new('active')
        ];
    }
    
}
