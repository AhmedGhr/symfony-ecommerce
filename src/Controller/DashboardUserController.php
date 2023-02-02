<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Carrier;
use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardUserController extends AbstractDashboardController
{
    /**
     * @Route("/user_dashboard", name="user_dashboard")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('E-BI3');
    }

    public function configureMenuItems(): iterable
    {

        yield MenuItem::linkToCrud('Products', 'fas fa-tags', Product::class);
    }
}
