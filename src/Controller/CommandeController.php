<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande", name="app_commande")
     */
    public function index(): Response
    {
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }


    /**
     * @Route ("/ShowOrder",name="SO")
     */
    function AfficheCommande(){
        $repo=$this->getDoctrine()->getRepository(Commande::class);
        $commande=$repo->findAll();
        return $this->render('commande/Affiche.html.twig',
            ['cc'=>$commande]);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/DeleteOrder/{id}", name="DO")
     */
    function DeleteCommande($id){
        $repo=$this->getDoctrine()->getRepository(Commande::class);
        $commandes=$repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($commandes);
        $em->flush();
        return $this->redirectToRoute('orders');
    }
}
