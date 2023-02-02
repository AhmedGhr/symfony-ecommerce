<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Auction;
use App\Entity\Product;
use App\Form\AuctionType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuctionController extends AbstractController
{
    /**
     * @Route("/auction/{id}", name="auction")
     */
    public function index(EntityManagerInterface $em, Request $request): Response
    {
        if ($this->getUser()) {
            $auc = new Auction();
            $id = $request->query->get('id');
            $slug = $request->query->get('slug');
            $comment = $request->query->get('comment');
            $bid = $request->query->get('bid');
            $auc->setBid($bid);
            $auc->setComment($comment);
            $auc->setDate(new \DateTime());
            $auc->setContributor($this->getUser()->getEmail());
            $auc->setIdProduit($id);
            $auc->setSlug($slug);
            $auc->setStatus(0);
            $em = $this->getDoctrine()->getManager();
            $em->persist($auc);
            $em->flush();


            return $this->render('auction/index.html.twig', [
                'controller_name' => 'AuctionController',
            ]);
        } else {
            $message = "You should login first to make a bid";
            echo "<script type='text/javascript'>alert('$message');</script>";
            //return $this->redirectToRoute('products');
            return $this->redirectToRoute('app_login');
        }
    }
}
