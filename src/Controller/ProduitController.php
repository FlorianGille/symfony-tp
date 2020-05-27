<?php

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produits", name="produits")
     */
    public function index()
    {
        $produitRepository = $this->getDoctrine()->getRepository(produit::class);
        $produits = $produitRepository->findBy(['actif'=>true]);

        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
            //autres données
        ]);
    }


    /**
     * @Route("/produits/details/{slug}", name="produits_detail", requirements={"slug" : "[a-zA-Z0-9\-]*"})
     * @param $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detail(Produit $produit){

        return $this->render('produit/details.html.twig',[
            'produit'=>$produit,
            'current_menu'=>'produits'
        ]);

    }

    /**
     * @Route("produits/search", name="produits_search")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function search(Request $request) {
        $search = $request->query->get("search");

        $produitRepository = $this->getDoctrine()->getRepository(produit::class);
        $produits = $produitRepository->search($search);

        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
        ]);
    }
}
