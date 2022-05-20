<?php

namespace App\Controller\Admin;

use App\Entity\Cut;
use App\Entity\Color;
use App\Entity\Option;
use App\Entity\Product;
use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use PhpParser\Node\Stmt\Catch_;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    //le user connecter
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
        
        
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
    
        //generer un root crresont a l'affichage 
        $url = $this->adminUrlGenerator
            ->setController(ProductCrudController::class)
            ->generateUrl();
            return $this->redirect($url);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SamiaMod');
    }

    public function configureMenuItems(): iterable
    {
        
        yield MenuItem::linkToDashboard('Accueil', 'fa fa-home');

        //gestion produit
        yield MenuItem::section('Gestion');
        yield MenuItem::subMenu('PRODUITS', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter un produit', 'fas fa-plus', Product::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste des produits', 'fas fa-eye', Product::class),
          ]);

        //gestion de Category
        yield MenuItem::subMenu('CATEGORIES', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter une categorie', 'fas fa-plus', Category::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Liste des categories', 'fas fa-eye', Category::class),
          ]);

        //gestion des Option 

      yield MenuItem::subMenu('Option', 'fas fa-bars')->setSubItems([
        MenuItem::linkToCrud('Ajouter une option', 'fas fa-plus', Option::class)->setAction(Crud::PAGE_NEW),
        MenuItem::linkToCrud('Liste des options', 'fas fa-eye', Option::class),
      ]);

      //gestion couleur
      yield MenuItem::subMenu('Couleur', 'fas fa-bars')->setSubItems([
        MenuItem::linkToCrud('Ajouter une couleur', 'fas fa-plus', Color::class)->setAction(Crud::PAGE_NEW),
        MenuItem::linkToCrud('Liste des couleurs', 'fas fa-eye', Color::class),
      ]);

       //gestion taille
       yield MenuItem::subMenu('Tailles', 'fas fa-bars')->setSubItems([
        MenuItem::linkToCrud('Ajouter une taille', 'fas fa-plus', Cut::class)->setAction(Crud::PAGE_NEW),
        MenuItem::linkToCrud('Liste des taille', 'fas fa-eye', Cut::class),
      ]);

       //yield  MenuItem::linkToLogout('Logout', 'fa fa-exit');
    }
    public function configureActions(): Actions
    {
      return parent::configureActions()
      ->add(Crud::PAGE_INDEX, Crud::PAGE_DETAIL);
    }
}
