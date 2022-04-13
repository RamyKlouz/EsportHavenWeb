<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produit", name="app_produit")
     */
    public function index(): Response
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }


    /**
     *      * @param Request $request
     * @Route ("/AddProduct",name="Addp")
     */
    function AddProduct(Request $request){
        $produit=new Produit();
        $form=$this->createForm(ProduitType::class,$produit);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('Aff');
        }
        return $this->render('produit/addproductform.html.twig',
            ['f'=>$form->createView()]);

    }

    /**
     * @Route ("/ShowProduct",name="Aff")
     */
    function Affiche(){
        $repo=$this->getDoctrine()->getRepository(Produit::class);
        $produit=$repo->findAll();
        return $this->render('produit/Affiche.html.twig',
            ['cc'=>$produit]);
    }

    /**
     * @Route ("/Clientproduit",name="Affccc")
     */
    function AfficheCli(){
        $repo=$this->getDoctrine()->getRepository(Produit::class);
        $produit=$repo->findAll();
        return $this->render('produit/Afficheclient.html.twig',
            ['cc'=>$produit]);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/DeleteProduct/{id}", name="DD")
     */
    function DeleteProduit($id){
        $repo=$this->getDoctrine()->getRepository(Produit::class);
        $produits=$repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($produits);
        $em->flush();
        return $this->redirectToRoute('Aff');
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/UpdateProduct/{id}",name="U")
     */
    function Update($id,Request $request){
        $repository=$this->getDoctrine()->getRepository(Produit::class);
        $produit=$repository->find($id);
        $form=$this->createForm(ProduitType::class,$produit);
        //$form->add('Modifier',SubmitType::class);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            //$em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('Aff');
        }
        return $this->render("produit/addproductform.html.twig",
            ['f'=>$form->createView()]);

    }

}
