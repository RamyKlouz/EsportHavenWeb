<?php

namespace App\Controller;

use App\Entity\Sponsors;
use App\Form\SponsorsType;
use App\Repository\CommandeRepo;
use App\Repository\QuizRepo;
use App\Repository\SponsorRepo;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @Route("/sponsors")
 */
class SponsorsController extends AbstractController
{
    /**
     * @Route("/", name="app_sponsors_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $sponsors = $entityManager
            ->getRepository(Sponsors::class)
            ->findAll();

        return $this->render('sponsors/index.html.twig', [
            'sponsors' => $sponsors,
        ]);
    }

    /**
     * @Route("/new", name="app_sponsors_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sponsor = new Sponsors();
        $form = $this->createForm(SponsorsType::class, $sponsor);
        $form->handleRequest($request);


        $sponsor->setDureeSpons(0);

        if ($form->isSubmitted() && $form->isValid()) {





            $file = $form->get('image')->getData();
            if ($file !== null) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                try {
                    $file->move(
                        $this->getParameter('images_directory'),
                        $fileName
                    );
                } catch (FileException $e) {

                    // ... handle exception if something happ

                }
                $sponsor->setImage($fileName);
            }













            $entityManager->persist($sponsor);
            $entityManager->flush();

            return $this->redirectToRoute('app_sponsors_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sponsors/new.html.twig', [
            'sponsor' => $sponsor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idSponsor}", name="app_sponsors_show", methods={"GET"})
     */
    public function show(Sponsors $sponsor): Response
    {
        return $this->render('sponsors/show.html.twig', [
            'sponsor' => $sponsor,
        ]);
    }

    /**
     * @Route("/{idSponsor}/edit", name="app_sponsors_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Sponsors $sponsor, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SponsorsType::class, $sponsor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_sponsors_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sponsors/edit.html.twig', [
            'sponsor' => $sponsor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idSponsor}", name="app_sponsors_delete", methods={"POST"})
     */
    public function delete(Request $request, Sponsors $sponsor, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sponsor->getIdSponsor(), $request->request->get('_token'))) {
            $entityManager->remove($sponsor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_sponsors_index', [], Response::HTTP_SEE_OTHER);
    }




    /**
     * @Route("/r/search_sponsor", name="search_sponsor", methods={"GET"})
     */
    public function search_usere(Request $request,NormalizerInterface $Normalizer,SponsorRepo $sponsorRepo): Response
    {

        $requestString=$request->get('searchValue');
        $requestString3=$request->get('orderid');
        //dump($requestString);
        // dump($requestString2);
        $user = $sponsorRepo->findUser($requestString,$requestString3);
        //dump($Hotel);
        $jsoncontentc =$Normalizer->normalize($user,'json',['groups'=>'posts:read']);
        //  dump($jsoncontentc);
        $jsonc=json_encode($jsoncontentc);
        //   dump($jsonc);
        if(  $jsonc == "[]" ) { return new Response(null); }
        else{ return new Response($jsonc); }

    }

















    ///////////////////stat//////////////////////////

    /**
     * @Route("/e/statsponsor", name="statsponsor", methods={"GET"})
     */
    public function reclamation_stat(SponsorRepo $rhrepo): Response
    {
        $nbrs[]=Array();

        $e1=$rhrepo->find_Nb_Rec_Par_Status("CDI");
        dump($e1);
        $nbrs[]=$e1[0][1];


        $e2=$rhrepo->find_Nb_Rec_Par_Status("CDD");
        dump($e2);
        $nbrs[]=$e2[0][1];

        /*
                $e3=$activiteRepository->find_Nb_Rec_Par_Status("Diffence");
                dump($e3);
                $nbrs[]=$e3[0][1];
        */

        dump($nbrs);
        reset($nbrs);
        dump(reset($nbrs));
        $key = key($nbrs);
        dump($key);
        dump($nbrs[$key]);

        unset($nbrs[$key]);

        $nbrss=array_values($nbrs);
        dump(json_encode($nbrss));

        return $this->render('sponsors/statsponsor.html.twig', [
            'nbr' => json_encode($nbrss),
        ]);
    }


















    /**
     *@Route("/pdf/reclam.pdf",name="pdf_index", methods={"GET"})
     */
    public function pdfReclamation(SponsorRepo $crepo)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('sponsors/pdf.html.twig', [
            'sponsors' =>$crepo->findAll(),
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A2', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("sponsorpdf.pdf", [
            "Attachment" => false
        ]);
    }

















}
