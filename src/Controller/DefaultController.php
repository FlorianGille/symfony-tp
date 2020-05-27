<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Service\MailTestServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/mail", name="mail")
     */
    public function mail(MailTestServices $email){
        $produitrepo = $this->getDoctrine()->getRepository(produit::class);
        $produit = $produitrepo->find(220);
        //envoi de mail
        $email->sendProduit($produit);
        return $this->redirectToRoute('produits');
    }
}
