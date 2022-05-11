<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProduitRepo;
use Symfony\Component\Routing\Annotation\Route;
use Endroid\QrCode\Builder\Builder;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Twilio\Rest\Client;


class ProduitController extends AbstractController
{
    /**
     * @Route("/produit", name="app_produit")
     */
    public function index(): Response
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }


    /**
     *      * @param Request $request
     * @Route ("/AddProduct",name="Addp")
     */
    function AddProduct(Request $request){
        $produit=new Produit();
        $form=$this->createForm(ProduitType::class,$produit);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();
            $this->addFlash(
                'notice',
                'Votre Produit a été ajouté !'
            );
            return $this->redirectToRoute('Aff');
        }
        return $this->render('produit/addproductform.html.twig',
            ['f'=>$form->createView()]);

    }

    /**
     * @Route ("/ShowProduct",name="Aff")
     */
    function Affiche( PaginatorInterface $paginator, Request $request){
        $repo=$this->getDoctrine()->getRepository(Produit::class);
        $produit2=$repo->findAll();
        $produit=$paginator->paginate($produit2,$request->query->getInt('page', 1), 10);



        return $this->render('produit/Affiche.html.twig',
            ['cc'=>$produit]);
    }

    /**
     * @Route ("/Clientproduit",name="Affccc")
     */
    function AfficheCli(){
        $repo=$this->getDoctrine()->getRepository(Produit::class);
        $produit=$repo->findAll();
        return $this->render('produit/Afficheclient.html.twig',
            ['cc'=>$produit]);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/DeleteProduct/{id}", name="DD")
     */
    function DeleteProduit($id){
        $repo=$this->getDoctrine()->getRepository(Produit::class);
        $produits=$repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($produits);
        $em->flush();
        return $this->redirectToRoute('Aff');
    }

    /**
     * @param $id
     * @Route("/qrProduct/{id}", name="DD")
     */
    function qrProduit($id){
        $repo=$this->getDoctrine()->getRepository(Produit::class);
        $produits=$repo->find($id);
        $qrcode=new QrCodeResponse('hello');
        return $this->render('produit/Affiche.html.twig',
            ['qrCode'=>$qrcode]);
    }

    /**
     * @param $id
     * @Route("/SearchProduct/{id}", name="SPbyID")
     */
    function SearchProduit($id){
        $repo=$this->getDoctrine()->getRepository(Produit::class);
        return $repo->find($id);

    }

    /**
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @Route("/UpdateProduct/{id}",name="U")
     */
    function Update($id,Request $request){

        $account_sid = 'AC18d4d7208681b4253eef04576916fa71';
        $auth_token = 'bd79bb6faaaeab06d6356c14890f5ccf';
        $twilio_number = "+19894399705";
        $repository=$this->getDoctrine()->getRepository(Produit::class);
        $produit=$repository->find($id);
        $form=$this->createForm(ProduitType::class,$produit);
        //$form->add('Modifier',SubmitType::class);
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            //$em->persist($produit);
            $em->flush();
            $client = new Client($account_sid, $auth_token);
            $client->messages->create(
            // Where to send a text message (your cell phone?)
                '+21625096773',
                array(
                    'from' => $twilio_number,
                    'body' => 'Votre produit a bien été modifié!'
                ));
            return $this->redirectToRoute('Aff');
        }
        return $this->render("produit/addproductform.html.twig",
            ['f'=>$form->createView()]);

    }



    /**
     * @Route("/ChercherProduit", name="ChercheProd", methods={"GET"})
     */
    public function chercherproduit(Request $request,NormalizerInterface $Normalizer,ProduitRepo $prodRepo): Response
    {

        $request1=$request->get('searchValue');
        $request2=$request->get('orderid');
        $prod = $prodRepo->findName($request1,$request2);
        $jsoncontentc =$Normalizer->normalize($prod,'json',['groups'=>'posts:read']);
        $jsonc=json_encode($jsoncontentc);
        if(  $jsonc == "[]" ) { return new Response(null); }
        else{ return new Response($jsonc); }

    }



    /**
     *@param $id
     *@Route("/Produit/{id}/details.pdf",name="pdf", methods={"GET"})
     */
    public function pdf($id)
    {
        // Configure Dompdf according to your needs
        $repo=$this->getDoctrine()->getRepository(Produit::class);
        $produits=$repo->find($id);
        $pdfOptions = new Options();
        $pdfOptions->set('isRemoteEnabled', true);
        $pdfOptions->set('isPhpEnabled', true);
        $pdfOptions->set('defaultFont', 'Times New Roman');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('produit/pdf.html.twig', [
            'produit' =>$produits,
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("produitpdf.pdf", [
            "Attachment" => false
        ]);



    }



}
