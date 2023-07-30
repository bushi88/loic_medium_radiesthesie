<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\HomeSlider;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\HomeSliderCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

#[Route('/admin')]
#[IsGranted('ROLE_ADMIN')]
class DashboardController extends AbstractDashboardController
{
    private $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    #[Route('/', name: 'app_admin')]
    public function index(): Response
    {
        // ouverture du dashboard sur la table du carousel
        $url = $this->adminUrlGenerator
            ->setController(HomeSliderCrudController::class)
            ->setAction('index')
            ->generateUrl();

        return $this->redirect($url);

        // return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Loic Medium Radiesthesie');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Retour à l\'Accueil', 'fas fa-home', 'app_home');
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Liste des Utilisateurs', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Liste des Catégories', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Liste des Articles', 'fas fa-list', Article::class);
        yield MenuItem::linkToCrud('Carousel Accueil', 'fas fa-images', HomeSlider::class);
    }
}