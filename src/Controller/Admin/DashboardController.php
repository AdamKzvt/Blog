<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Article;
use App\Entity\Categorie;
use PhpParser\Node\Stmt\Label;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    )
    {      
    }
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
    $url = $this->adminUrlGenerator->setController(crudControllerFqcn:ArticleCrudController::class)
        ->generateUrl();

        return $this->redirect($url); 
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Blog');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::subMenu('Article', icon:'fas fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('Tous les articles', icon:'fas fa-newspaper',entityFqcn: Article::class),
            MenuItem::linkToCrud('Ajoutez categorie', icon:'fas fa-plus',entityFqcn: Categorie::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Categories', icon:'fas fa-list',entityFqcn: Categorie::class),
            MenuItem::linkToCrud('Utilissate', icon:'fas fa-list',entityFqcn: User::class),
           
            


        ]);
    }
}
