<?php

namespace LavandaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        //Buscar datos de la empresa
        /*$em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            "SELECT e FROM LavandaBundle:Empresa e 
            WHERE e.idempresa IS NOT NULL"
        );
        $query->setMaxResults(1);
        $empresa = $query->getOneOrNullResult(); */
        $user = $this->getUser();
        if($user->getRole() == "ROLE_ADMIN" || $user->getRole() == "ROLE_USER"){
            return $this->redirectToRoute('citas_index');
        }else{
            return $this->render('LavandaBundle:Default:index.html.twig');
        }
       //return $this->redirectToRoute('home');
    }
}
