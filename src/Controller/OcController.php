<?php

namespace App\Controller;
use App\Entity\Tournois;
use App\Repository\TournoisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OcController extends AbstractController
{
    /**
     * @Route("/oc", name="app_oc")
     */
    public function index(TournoisRepository $repo): Response
    {
        $compet=$repo->findAll();
        $rdvs = [];
        foreach ($compet as $event)
        {
            $rdvs[]=[
                'title'=>$event->getNom(),
                'start'=>$event->getDatedeb()->format("Y-m-d"),
                'end'=>$event->getDatefin()->format("Y-m-d"),
                'backgroundColor'=> '#0ec51',
                'borderColor'=> 'green',
                'textColor' => 'black'
            ];
        }
        $data = json_encode($rdvs);
        return $this->render('oc/index.html.twig',compact('data' ));

    }


}
