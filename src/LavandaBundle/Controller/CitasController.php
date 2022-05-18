<?php

namespace LavandaBundle\Controller;

use LavandaBundle\Entity\Citas;
use LavandaBundle\Form\Citas2Type;
use LavandaBundle\Form\CitasType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CitasController extends Controller
{
    public function indexAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(CitasType::class);
        $form->handleRequest($request);

        return $this->render('LavandaBundle:Citas:index.html.twig', array(
            "form"=>$form->createView()
        ));
    }

    public function buscarCitasAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $idempleado = $request->get('idempleado');

        $citas = $em->getRepository('LavandaBundle:Citas')->findBy(array(
            "idempleado"=>$idempleado
        ));

        $arrCitas = array();

        foreach ($citas as $cita){
            if($cita->getIdestatus()->getClave() == "EC1"){
                $color = "#D8C223";
            }else if($cita->getIdestatus()->getClave() == "EC4" || $cita->getIdestatus()->getClave() == "EC5"){
                $color = "#73C83C";
            }else if($cita->getIdestatus()->getClave() == "EC3"){
                $color = "#CF3831";
            }

            array_push($arrCitas, [
                "id"=>$cita->getIdcita() != null ? $cita->getIdcita() : "0" ,
                "title"=>$cita->getIdcliente()->getNombre() != null ? "Cita agendada para ".$cita->getIdcliente()->getNombre()." ".$cita->getIdcliente()->getApellido() : "",
                "start"=>$cita->getFechacita()->format("Y-m-d") != null ? $cita->getFechacita()->format("Y-m-d")."T".$cita->getHorarioinicio()->format("H:i") : "2021-07-12",
                "end"=>$cita->getFechacita()->format("Y-m-d") != null ? $cita->getFechacita()->format("Y-m-d")."T".$cita->getHorariofin()->format("H:i") : "2021-07-12",
                "allDay"=>false,
                "description"=>"El servicio solicitado es ".$cita->getIdservicio()->getNombre(),
                "color"=>$color
            ]);
        }
        return new JsonResponse($arrCitas);
    }

    public function actualizarEstatusCitaAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $idcita = $request->get('idcita');
        $opcion = $request->get('opcion');

        $response = new Response();

        $cita = $em->getRepository('LavandaBundle:Citas')->find($idcita);

        if($idcita != "" && $opcion != ""){
            if($opcion == "1"){
                $estatusCita = $em->getRepository('LavandaBundle:Estatuscita')->findOneBy(array(
                    "clave"=>"EC4"
                ));

                $cita->setIdestatus($estatusCita);

                $em->persist($cita);
            }else if($opcion == "2"){
                $em->remove($cita);
            }



            $flush = $em->flush();

            if($flush == null){
                $response->setStatusCode(200);
            }else{
                $response->setStatusCode(500);
            }

        }else{
            $response->setStatusCode(500);
        }
        return $response;
    }

    public function historialCitasAction(){
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
            "SELECT c FROM LavandaBundle:Citas c 
            LEFT JOIN LavandaBundle:Estatuscita e WITH c.idestatus = e.idestatus 
            WHERE (e.clave = 'EC3' OR e.clave = 'EC5')"
        );

        $citas = $query->getResult();

        return $this->render('LavandaBundle:Citas:historial.html.twig', array(
            "citas" => $citas
        ));
    }

    public function listarCitasClienteAction($idcliente = null){
        $em = $this->getDoctrine()->getManager();

        $cliente = $em->getRepository('LavandaBundle:Cliente')->find($idcliente);

        $citas = $em->getRepository('LavandaBundle:Citas')->findBy(array(
            "idcliente" => $cliente->getIdcliente()
        ));

        return $this->render('LavandaBundle:Clientes:procesos.html.twig', array(
            "citas" => $citas,
            "cliente" => $cliente
        ));
    }

    public function registraCitaProcesoAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $idservicio = $request->get('idservicio');
        $idlongitud = $request->get('idlongitud');
        $idempleado = $request->get('idempleado');
        $idcliente = $request->get('idcliente');
        $fecha = $request->get('fecha');
        $hora = $request->get('hora');


        $response = new Response();
        if($idservicio != "" && $idempleado != "" && $fecha != "" && $hora != ""){

            $oFecha = new \DateTime($fecha);
            $oHora = new \DateTime($hora);

            $empleado = $em->getRepository('LavandaBundle:Empleado')->find($idempleado);
            $servicio = $em->getRepository('LavandaBundle:Servicio')->find($idservicio);
            $cliente = $em->getRepository('LavandaBundle:Cliente')->find($idcliente);

            if($idlongitud != null){
                $longitud = $em->getRepository('LavandaBundle:Serviciolongitud')->find($idlongitud);
            }

            $estatus = $em->getRepository('LavandaBundle:Estatuscita')->findOneBy(array(
                "clave"=>"EC1"
            ));

            //Buscar si el empleado tiene citas registradas para la fecha seleccionada
            $citas = $em->getRepository('LavandaBundle:Citas')->findBy(array(
                "idempleado"=>$empleado->getIdempleado(),
                "fechacita"=> $oFecha,
            ));

            $horaSel = $oHora->format("H:i");
            $segundosHoraInicial = strtotime($horaSel);

            //Agregar un minuto a la hora inicial
            $addSecondTimeStart = 1 * 60;
            $horaSel = date("H:i", $segundosHoraInicial+$addSecondTimeStart);

            //Verificar el tiempo que dura el servicio
            $tiempoServicio = $servicio->getTiempo();
            $segundosAdd = $tiempoServicio * 60;
            $horaFinal = date("H:i", $segundosHoraInicial+$segundosAdd);

            $from = new \DateTime($oFecha->format("Y-m-d")." ".$horaSel);
            $to = new \DateTime($oFecha->format("Y-m-d")." ".$horaFinal);

            if($citas == null){
                //Validar si el cliente no tiene citas previamente registradas para ese día
                $citasCliente = $em->getRepository('LavandaBundle:Citas')->findBy(array(
                    "idcliente" => $cliente->getIdcliente(),
                    "fechacita"=> $oFecha,
                ));

                if($citasCliente == null){
                    $nuevaCita = new Citas();
                    $nuevaCita->setIdcliente($cliente);
                    $nuevaCita->setIdempleado($empleado);
                    $nuevaCita->setIdservicio($servicio);
                    $nuevaCita->setFechacita($oFecha);
                    $nuevaCita->setHorarioinicio($from);
                    $nuevaCita->setHorariofin($to);
                    $nuevaCita->setIdestatus($estatus);
                    //$info["idcortesia"] != "" ? $nuevaCita->setIdcortesia($cortesia) : null;
                    $idlongitud != null ? $nuevaCita->setIdserviciolongitud($longitud) : "";

                    $em->persist($nuevaCita);
                    $flush = $em->flush();

                    if($flush == null){
                        $response->setStatusCode(200);
                    }else{
                        $response->setStatusCode(500);
                    }
                }else{
                    //Validar si el horario seleccionado no fue previamente registrado
                    $flag = false;
                    $arrHoras = array();
                    for($i = 0; $i < count($citasCliente); $i ++){
                        $hInicio = date_format($citasCliente[$i]->getHorarioinicio(), "H:i");
                        $hFin = date_format($citasCliente[$i]->getHorariofin(), "H:i");

                        array_push($arrHoras, [
                            "horario"=>$hInicio."-".$hFin,
                        ]);
                    }

                    for ($i = 0; $i < count($arrHoras); $i++){
                        $arrHorario = explode("-",$arrHoras[$i]["horario"]);
                        $horaInicio = $arrHorario[0];
                        $horaFinalizado = $arrHorario[1];

                        if($this->validadorHoras($horaSel, $horaFinal, $horaInicio) || $this->validadorHoras($horaSel, $horaFinal, $horaFinalizado)){
                            $flag = true;
                        }
                    }

                    if(!$flag){
                        $nuevaCita = new Citas();
                        $nuevaCita->setIdcliente($cliente);
                        $nuevaCita->setIdempleado($empleado);
                        $nuevaCita->setIdservicio($servicio);
                        $nuevaCita->setFechacita($oFecha);
                        $nuevaCita->setHorarioinicio($from);
                        $nuevaCita->setHorariofin($to);
                        $nuevaCita->setIdestatus($estatus);
                        //$info["idcortesia"] != "" ? $nuevaCita->setIdcortesia($cortesia) : null;
                        $idlongitud != null ? $nuevaCita->setIdserviciolongitud($longitud) : "";

                        $em->persist($nuevaCita);
                        $flush = $em->flush();

                        if($flush == null){
                            $response->setStatusCode(200);
                        }else{
                            $response->setStatusCode(500);
                        }

                    }else{
                        $response->setStatusCode(500);
                    }
                }


            }else{
                $citasCliente = $em->getRepository('LavandaBundle:Citas')->findBy(array(
                    "idcliente" => $cliente->getIdcliente(),
                    "fechacita"=> $oFecha,
                ));

                if($citasCliente == null){
                    $flag = false;
                    $arrHoras = array();
                    for($i = 0; $i < count($citas); $i ++){
                        $hInicio = date_format($citas[$i]->getHorarioinicio(), "H:i");
                        $hFin = date_format($citas[$i]->getHorariofin(), "H:i");

                        array_push($arrHoras, [
                            "horario"=>$hInicio."-".$hFin,
                        ]);
                    }

                    for ($i = 0; $i < count($arrHoras); $i++){
                        $arrHorario = explode("-",$arrHoras[$i]["horario"]);
                        $horaInicio = $arrHorario[0];
                        $horaFinalizado = $arrHorario[1];

                        if($this->validadorHoras($horaSel, $horaFinal, $horaInicio) || $this->validadorHoras($horaSel, $horaFinal, $horaFinalizado)){
                            $flag = true;
                        }
                    }

                    if(!$flag){
                        $nuevaCita = new Citas();
                        $nuevaCita->setIdcliente($cliente);
                        $nuevaCita->setIdempleado($empleado);
                        $nuevaCita->setIdservicio($servicio);
                        $nuevaCita->setFechacita($oFecha);
                        $nuevaCita->setHorarioinicio($from);
                        $nuevaCita->setHorariofin($to);
                        $nuevaCita->setIdestatus($estatus);
                        //$info["idcortesia"] != "" ? $nuevaCita->setIdcortesia($cortesia) : null;
                        $idlongitud != null ? $nuevaCita->setIdserviciolongitud($longitud) : "";

                        $em->persist($nuevaCita);
                        $flush = $em->flush();

                        if($flush == null){
                            $response->setStatusCode(200);
                        }else{
                            $response->setStatusCode(500);
                        }

                    }else{
                        sort($arrHoras);
                        $arrOrdenado = end($arrHoras);
                        $arrHorario = explode("-",$arrOrdenado["horario"]);
                        $horaRecomendada = $arrHorario[1];
                        if($horaRecomendada >= "18:00"){
                            $response->setStatusCode(500);
                            $mensaje = "¡Horario no disponible! Se le recomienda agendar su cita para el día ".$oFecha->modify('+1 day')->format("Y-m-d");
                        }else{
                            $response->setStatusCode(500);
                            $mensaje = "¡Horario no disponible! Se le recomienda seleccionar el horario de las ".$horaRecomendada." para agendar su cita";
                        }
                    }
                }else{
                    $response->setStatusCode(500);
                }
            }

        }else{
            $response->setStatusCode(500);
        }

        return $response;
    }

    function validadorHoras($h1, $h2, $hSel){
        $horaDesde = \DateTime::createFromFormat('!H:i', $h1);
        $horaHasta = \DateTime::createFromFormat('!H:i', $h2);
        $horaSel = \DateTime::createFromFormat('!H:i', $hSel);
        if($horaDesde > $horaHasta) $horaHasta->modify('+1 day');
        return ($horaDesde <= $horaSel && $horaSel <= $horaHasta);
    }

    public function registrarCitaAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(Citas2Type::class);
        $form->handleRequest($request);

        return $this->render('LavandaBundle:Citas:registrar.html.twig', array(
            "form" => $form->createView()
        ));
    }
}
