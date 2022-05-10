<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Sponsors;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class MobileSponsorController extends AbstractController
{






    /**
     * @Route("/sponsors_mobile", name="sponsors_mobile")
     */
    public function hotelmobile( NormalizerInterface  $normalizer)
    {

        $Sponsors = $this->getDoctrine()->getRepository(Sponsors::class)->findAll();
        $json = $normalizer->normalize($Sponsors, "json", ['groups' => ['sponsors','sponsors']]);
        return new JsonResponse($json);

    }





    
     /**
     * @Route("/newsposnor_mobile/{societe}/{nomSponsor}/{montant}/{dureeSpons}/{typeSponsor}/{image}", name="newsposnor_mobile", methods={"GET","POST"})
     */
    public function newhotel($societe,$nomSponsor,$montant,$dureeSpons,$typeSponsor,$image,NormalizerInterface  $normalizer )
    {

        $produit = new Sponsors();
        $produit->setSociete($societe);
        $produit->setNomSponsor($nomSponsor);
        $produit->setMontant($montant);

        $produit->setDureeSpons($dureeSpons);

        $produit->setTypeSponsor($typeSponsor);

        $produit->setImage($image);
      
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($produit);
        $entityManager->flush();
        $json = $normalizer->normalize($produit, "json", ['groups' => ['sponsors']]);
        return new JsonResponse($json);

    }








    /**
     * @Route("/SupprimerSponsor", name="SupprimerSponsor")
     */
    public function SupprimerSponsor(Request $request)
    {

        $idE = $request->get("idSponsor");
        $em = $this->getDoctrine()->getManager();
        $Sponsors = $em->getRepository(Sponsors::class)->find($idE);
        if($Sponsors != null)
        {
            $em->remove($Sponsors);
            $em->flush();
            $serializer = new Serializer([new ObjectNormalizer()]);
            $formated = $serializer->normalize("Sponsors ete supprimer avec succées ");
            return new JsonResponse($formated);
        }

    }













    
    /******************Modifier Fornisseur*****************************************/
    /**
     * @Route("/updateSponsor", name="updateSponsor")
     */
    public function updateSponsor(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $Sponsor = $this->getDoctrine()->getManager()->getRepository(Sponsors::class)->find($request->get("idSponsor"));


        $Sponsor->setNomSponsor($request->get("nomSponsor"));
        $Sponsor->setSociete($request->get("societe"));
        $Sponsor->setMontant($request->get("montant"));

        $Sponsor->setDureeSpons($request->get("dureeSpons"));


        $em->persist($Sponsor);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Sponsor);
        return new JsonResponse("Sponsor a ete modifiee avec success.");

    }








}
