<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Entity\ProductCut;
use App\Entity\ProductColor;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;

class ProductCrudController extends AbstractCrudController
{
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPaginatorPageSize(5)
            ->setDefaultSort(['createdAt' => 'ASC']);
    }

    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    // public function configureActions(Actions $actions): Actions
    // {
    //     $ProduitAssociated = Action::new(self::ACTION_PRODUCTASSOCIEATED) 
    // }
    public function configureFields(string $pageName): iterable
    {
         
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('refProduct')->hideOnForm(),
            TextField::new('nameProduct', 'Nom de produit'),
            TextEditorField::new('descriptionProduct', 'Description'),
            MoneyField::new('pricesHTVA', 'prix HTVA')->setCurrency('EUR'),
            AssociationField::new('type')->setQueryBuilder(function (QueryBuilder $queryBuilder) {
                $queryBuilder->where('entity.active = true');
            }),
            BooleanField::new('lease', 'A vendre'),
            BooleanField::new('sale', 'A louer'),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('updateAt')->hideOnForm()
            
            

        ];
    }
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Product) return;

        $entityInstance->setRefProduct(md5(uniqid()));

        parent::persistEntity($entityManager, $entityInstance);
    }
    
}
