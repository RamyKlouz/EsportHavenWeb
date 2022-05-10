<?php

namespace App\Controller;

use App\Repository\QuestionRepo;
use App\Repository\SponsorRepo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="app_client")
     */
    public function index(SponsorRepo $sponsorRepo): Response
    {
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
            'Sponsors' => $sponsorRepo->createQueryBuilder('u')->select('u')->getQuery()->getResult()

        ]);
    }
}
