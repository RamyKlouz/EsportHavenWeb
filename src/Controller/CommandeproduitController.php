<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Commandeproduit;
use App\Controller\ProduitController;
use App\Entity\Produit;
use App\Form\ProduitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeproduitController extends AbstractController
{
    /**
     * @Route("/commandeproduit", name="app_commandeproduit")
     */
    public function index(): Response
    {
        return $this->render('commandeproduit/index.html.twig', [
            'controller_name' => 'CommandeproduitController',
        ]);
    }

    /**
     * @Route ("/ShowPanier",name="SP")
     */
    function AffichePanier(){
        $repo=$this->getDoctrine()->getRepository(Commandeproduit::class);
        $commandeproduit=$repo->findAll();
        return $this->render('commandeproduit/Affiche.html.twig',
            ['cpp'=>$commandeproduit]);
    }

    /**
     * @Route ("/Catalog",name="cata")
     */
    function ShowProducts(){
        $repo=$this->getDoctrine()->getRepository(Produit::class);
        $produit=$repo->findAll();
        return $this->render('commandeproduit/Affiche2.html.twig',
            ['pp'=>$produit]);
    }



    /**
     * @param $id
     * @Route("/SearchProductforPanier/{id}", name="SPbyID2")
     */
    function SearchProduit($id){
        $repo=$this->getDoctrine()->getRepository(Produit::class);
        return $repo->find($id);
    }


    /**
     * @param $pid
     * @param $oid
     * @Route("/AddtoPanier/{pid}&{oid}", name="AtP")
     */


    function AddtoPanier($pid,$oid){

        $em=$this->getDoctrine()->getManager();
        if ($this->Searchintable($pid) !== null) {
            $produitc=Searchintable($pid);
            $newq=$produitc->
            $produitc->setQuantite($newq);

            $em->flush();
            return $this->redirectToRoute('SP');

        } else {
            $produitc=new Commandeproduit();
            $produitc->setProductid($pid);
            $produitc->setOrderid($oid);
            $produitc->setQuantite('1');
            $produitc->setSommeprix('2');
            $em->persist($produitc);
            $em->flush();
            return $this->redirectToRoute('SP');
        }



    }
    /**
     * @param $pid
     * @Route("/Searchintable/{pid}", name="sit")
     */

    function Searchintable($pid){
        $repo=$this->getDoctrine()->getRepository(Produit::class);
        return $repo->findOneBy(array('productID' => $pid));
    }

}
