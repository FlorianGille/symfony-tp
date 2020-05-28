<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Service\MailTestServices;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produits", name="produits")
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return \Symfony\Component\HttpFoundation\Response
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
     * @param Produit $produit
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
     * @param PaginatorInterface $paginator
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


    /**
     * @Route("produits/contact", name="send_mail")
     * @param Request $request
     * @param MailTestServices $mail
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function contactUs(Request $request, MailTestServices $mail)
    {
        $content = $request->query->get("mail");
        $produit = $request->query->get("produit");
        $mail->contactUs($content, $produit);
        return $this->redirectToRoute('produits');
    }

    public function lowStock(MailTestServices $mail) {
        $produitRepo = $this->getDoctrine()->getRepository(Produit::class);
        $produits = $produitRepo->shortStock(10);
        $mail->lowStock($produits);
    }
}
