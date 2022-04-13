<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComiteController extends AbstractController
{
    /**
     * @Route("/comite", name="app_comite")
     */
    public function index(): Response
    {
        return $this->render('comite/index.html.twig', [
            'controller_name' => 'ComiteController',
        ]);
    }
}
