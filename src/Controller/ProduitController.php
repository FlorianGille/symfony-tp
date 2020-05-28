<?php

namespace App\Controller;

use App\Entity\Produit;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produits", name="produits")
     */
    public function index(Request $request,PaginatorInterface $paginator)
    {
        $produitRepository = $this->getDoctrine()->getRepository(produit::class);
        $donnees = $produitRepository->findBy(['actif'=>true]);

        $produits = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
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
    public function search(Request $request,PaginatorInterface $paginator) {
        $search = $request->query->get("search");

        $produitRepository = $this->getDoctrine()->getRepository(produit::class);
        $donnees = $produitRepository->search($search);

        $produits = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
        ]);
    }
}
