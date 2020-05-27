<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Form\ProduitEditType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    /**
     * @Route("/admin/produits", name="admin_produit")
     */
    public function index()
    {
//        $user = $this->getUser();
//        $user = $this->isGranted('ROLE_TOTO');
//
//        $this->denyAccessUnlessGranted('ROLE_TITI');

        $produitsRepository = $this->getDoctrine()->getRepository(produit::class);
        $produits = $produitsRepository->findAll();
        return $this->render('admin/produit/index.html.twig',[
            'produits' => $produits
        ]);
    }


    /**
     * @Route  ("/admin/produit/add", name="admin.produit.add")
     */
    public function add(Request $request){
        $produit=new Produit();
        $form = $this->createForm(ProduitEditType::class,$produit);
        // on check la request
        $form->handleRequest($request);
        //si on a une requete et que le form et valide on flush
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('produits');
        }

        return $this->render('admin/produit/add.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/produit/{id}", name="admin.produit.edit")
     */
    public function edit(Produit $produit, Request $request){
        $form = $this->createForm(ProduitEditType::class,$produit);
        // on check la request
        $form->handleRequest($request);
        //si on a une requete et que le form et valide on flush
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('produits');
        }
        return $this->render('admin/produit/edit.html.twig',[
            'form' => $form->createView()
            ]);
    }


    /**
     * @Route("/admin/produit/delete/{id}", name="admin.produit.delete", methods="DELETE")
     */
    public function delete(Produit $produit,Request $request){
        return $this->redirectToRoute('admin_produit');
    }



}
