<?php

namespace App\Controller;

use App\Repository\TournoisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="app_client")
     */
    public function index(TournoisRepository $card): Response
    {
        $sq=$card->findAll();

        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
            "tournois" => $sq
        ]);
    }

}
