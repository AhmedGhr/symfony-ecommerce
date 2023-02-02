<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListProduitController extends AbstractController
{
    /**
     * @Route("/list/produit", name="list_produit")
     */
    public function index(): Response
    {
        return $this->render('list_produit/index.html.twig', [
            'controller_name' => 'ListProduitController',
        ]);
    }
}
