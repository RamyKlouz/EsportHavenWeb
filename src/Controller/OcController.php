<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OcController extends AbstractController
{
    /**
     * @Route("/oc", name="app_oc")
     */
    public function index(): Response
    {
        return $this->render('oc/index.html.twig', [
            'controller_name' => 'OcController',
        ]);
    }


}
