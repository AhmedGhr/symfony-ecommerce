<?php

namespace App\Controller;

use App\Form\ProduitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddProduitController extends AbstractController
{
    /**
     * @Route("/add", name="add_produit")
     */
    public function formExampleAction(Request $request)
    {
        $form = $this->createForm(ProduitType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $product = $form->getData();

            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('add_produit');
        }

        return $this->render('list_produit/addproduit.html.twig', [
            'productForm' => $form->createView()
        ]);
    }
}
