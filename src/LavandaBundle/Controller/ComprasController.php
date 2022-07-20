<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Comprasproducto;
use LavandaBundle\Form\ComprasproductoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Session\Session;

class ComprasController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function indexAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $compras = $em->getRepository('LavandaBundle:Comprasproducto')->findAll();

        $compra = new Comprasproducto();

        $form = $this->createForm(ComprasproductoType::class, $compra);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            if($form->isValid()){
                //try {
                    $producto = $compra->getIdproducto();

                    if($producto){
                        $stock = $producto->getStock();
                        $producto->setStock($stock +  $compra->getCantidad());
                        $em->persist($producto);
                    }

                    //Subir los archivox PDF y XML
                    $pdf = $form["pdf"]->getData();
                    $xml = $form["xml"]->getData();

                    $basedir = "uploads/compras/";
                    if(!file_exists($basedir)){
                        mkdir($basedir, 777,  true);
                    }

                    if($pdf != null){
                        $ext = $pdf->guessExtension();
                        $file_name = "pdf-".$producto->getIdproducto()."_".time().".".$ext;
                        $compra->setRutaarchivo($basedir);
                        $compra->setNombrearchivo($file_name);
                        $pdf->move($basedir, $file_name);
                    }

                    if($xml != null){
                        $file_name_xml = "xml-".$producto->getIdproducto()."-".time().".xml";
                        $compra->setRutaxml($basedir);
                        $compra->setNombrexml($file_name_xml);
                        $xml->move($basedir, $file_name_xml);
                    }

                    $em->persist($compra);
                    $em->flush();

                    $status = "Compra registrada exitosamente, se agregó al producto ".$producto->getNombre()." la cantidad de " .$compra->getCantidad()." ".$producto->getUnidadmedida()->getNombre(). "(s)" ;
                    $this->session->getFlashBag()->add("info","success");
                    $this->session->getFlashBag()->add("status",$status);
                    return $this->redirectToRoute("compras_index");

                /*}catch (\Exception $exception){
                    $status = $exception->getMessage();
                    $this->session->getFlashBag()->add("info","error");
                    $this->session->getFlashBag()->add("status",$status);
                    return $this->redirectToRoute("compras_index");
                }*/

            }else{
                $status = "Algunos datos del formulario no son válidos";
                $this->session->getFlashBag()->add("info","success");
                $this->session->getFlashBag()->add("status",$status);
                return $this->redirectToRoute("compras_index");
            }
        }

        return $this->render('LavandaBundle:Compras:index.html.twig', [
            "compras" => $compras,
            "form" => $form->createView()
        ]);
    }

    public function descargarXMLAction($idcompra)
    {
        $em = $this->getDoctrine()->getManager();
        $compra = $em->getRepository('LavandaBundle:Comprasproducto')->find($idcompra);
        $ruta = $compra->getRutaxml();
        $path = $this->get('kernel')->getRootDir()."/../web/".$ruta;
        $file = $path.$compra->getNombrexml();
        $response = new BinaryFileResponse($file);
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $compra->getNombrexml());
        return $response;
    }

}
