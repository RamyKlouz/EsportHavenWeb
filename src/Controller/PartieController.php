<?php

namespace App\Controller;

use App\Entity\Partie;
use App\Form\PartieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/partie")
 */
class PartieController extends AbstractController
{
    /**
     * @Route("/", name="app_partie_index", methods={"GET" , "POST"})
     */
    public function index(EntityManagerInterface $entityManager , Request $request, PaginatorInterface $paginator): Response
    {
        $parties = $entityManager
            ->getRepository(Partie::class)
            ->findAll();

        $allparties = $paginator->paginate(
            $parties, //On passe les donnees
            $request->query->getInt('page', 1), //numero de la page en cours , 1 par defaut
            3
        );

        $partie = new Partie();
        $form = $this->createForm(PartieType::class, $partie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($partie);
            $entityManager->flush();



            return $this->redirectToRoute('app_partie_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('partie/index.html.twig', [
            'parties' => $parties,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/new", name="app_partie_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $partie = new Partie();
        $form = $this->createForm(PartieType::class, $partie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($partie);
            $entityManager->flush();

            $this->addFlash('success', 'bien ajouté avec succés');
            return $this->redirectToRoute('app_partie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('partie/new.html.twig', [
            'partie' => $partie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idpartie}", name="app_partie_show", methods={"GET"})
     */
    public function show(Partie $partie): Response
    {
        return $this->render('partie/show.html.twig', [
            'partie' => $partie,
        ]);
    }

    /**
     * @Route("/{idpartie}/edit", name="app_partie_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Partie $partie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PartieType::class, $partie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('info', 'modifié avec succés');
            return $this->redirectToRoute('app_partie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('partie/edit.html.twig', [
            'partie' => $partie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idpartie}", name="app_partie_delete", methods={"POST"})
     */
    public function delete(Request $request, Partie $partie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partie->getIdpartie(), $request->request->get('_token'))) {
            $entityManager->remove($partie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_partie_index', [], Response::HTTP_SEE_OTHER);
    }
}
