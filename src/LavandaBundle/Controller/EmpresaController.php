<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Empresa;
use LavandaBundle\Form\EmpresaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class EmpresaController extends Controller
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function indexAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            "SELECT e FROM LavandaBundle:Empresa e 
            WHERE e.idempresa IS NOT NULL"
        );
        $query->setMaxResults(1);
        $empresa = $query->getOneOrNullResult();

        if($empresa == null){
            $empresa = new Empresa();
        }

        $form = $this->createForm(EmpresaType::class, $empresa);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $basedir = "uploads/empresa";
            $path = $basedir."/logo/";
            if(!file_exists($path)){
                mkdir($path,777, true);
            }

            $file = $form["logo"]->getData();
            if(!empty($file) && $file != null){
                $ext = $file->guessExtension();
                $file_name = "logo.".$ext;
                $file->move($path, $file_name);
                $empresa->setRutalogo($path);
                $empresa->setNombrelogo($file_name);
            }

            $em->persist($empresa);
            $em->flush();

            $status = "Datos actualizado correctamente";
            $this->session->getFlashBag()->add("info","success");
            $this->session->getFlashBag()->add("status",$status);
            return $this->redirectToRoute("empresa_index");
        }

        return $this->render('LavandaBundle:Empresa:index.html.twig', array(
            "form"=>$form->createView(),
        ));
    }
}
