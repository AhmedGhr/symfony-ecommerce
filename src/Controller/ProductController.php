<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Product;
use App\Entity\User;
use App\Entity\Auction;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/", name="products")
     */
    public function index(Request $request): Response
    {
        $search = new Search();
        $products = $this->entityManager->getRepository(Product::class)->findAll();

        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        //findBy(array('contributor' => $this->getUser()->getEmail()));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $products = $this->entityManager->getRepository(Product::class)->findWithsearch($search);
        } else {

            $products = $this->entityManager->getRepository(Product::class)->findAll();
            //$contributor = $this->entityManager->getRepository(User::class)->findBy(array('firstname' => $this->getUser()->getFirstname()));
        }
        return $this->render('product/index.html.twig', [
            'products' => $products,
            //'contributor' => $contributor,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/produit/{slug}/{id}", name="product")
     */
    public function show($slug, $id): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->findOneBySlug($slug);
        $auctions = $this->entityManager->getRepository(Auction::class)->findBy(array('slug' => $slug));



        //$status = $auctions[$id]->getStatus();
        if (!$product) {
            return $this->redirectToRoute('products');
        }

        if ($this->getUser()) {
            $user = $this->getUser()->getEmail();;
        } else {
            $user = '';
        }
        return $this->render('product/show.html.twig', [
            'product' => $product,
            'auctions' => $auctions,
            'user' => $user

        ]);
    }

    /**
     * @Route("/produit/{id}", name="accept_bid")
     */
    public function accept($id)
    {
        $product = $this->entityManager->getRepository(Auction::class)->findOneById($id);

        $product->setStatus(1);
        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();
        return $this->redirectToRoute('product', array(
            'id' => $product->getId(), 'slug' => $product->getSlug()
        ));
    }
}
