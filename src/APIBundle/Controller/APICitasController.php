<?php

namespace APIBundle\Controller;

use APIBundle\Services\Helpers;
use APIBundle\Services\JwtAuth;
use LavandaBundle\Entity\Citas;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class APICitasController extends Controller
{
    public function validarCitaAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $helpers = $this->get(Helpers::class);

        $token = $request->request->get('token');
        $cita = $request->request->get('cita');


        if($token != "" && $cita != null){
            $jwt_auth = $this->get(JwtAuth::class);
            $tokenValido = $jwt_auth->checkToken($token);

            if($tokenValido){
                $info = json_decode($cita, true);
                //Convertir la fecha y la hora a objetos datetime
                $oFecha = new \DateTime($info["fecha"]);
                $fechaSel = date_format($oFecha, 'Y-m-d');
                $oHora = new \DateTime($info["hora"]);

                //Buscar los datos del empleado
                $empleado = $em->getRepository('LavandaBundle:Empleado')->find($info["idempleado"]);

                //Buscar los datos del servicio
                $servicio = $em->getRepository('LavandaBundle:Servicio')->find($info["idservicio"]);

                //Buscar los datos del cliente
                $cliente = $em->getRepository('LavandaBundle:Cliente')->findOneBy(array(
                    "email"=>$info["email"]
                ));

                $estatus = $em->getRepository('LavandaBundle:Estatuscita')->findOneBy(array(
                    "clave"=>"EC1"
                ));

                if($info["idcortesia"] != null){
                    $cortesia = $em->getRepository('LavandaBundle:Cortesias')->find($info["idcortesia"]);
                }

                //Buscar las longitudes en caso de que el cliente lo haya seleccionado desde la app
                $info["idlongitud"] != null ? $longitud = $em->getRepository('LavandaBundle:Serviciolongitud')->find($info["idlongitud"]) : "";

                //Buscar si el empleado tiene citas registradas para la fecha seleccionada
                $citas = $em->getRepository('LavandaBundle:Citas')->findBy(array(
                    "idempleado"=>$info["idempleado"],
                    "fechacita"=> $oFecha,
                ));

                /*$query = $em->createQuery(
                    "SELECT c FROM LavandaBundle:Cita c 
                    LEFT JOIN LavandaBundle:Empleado e WITH c.idempleado = e.idempleado 
                    LEFT JOIN LavandaBundle:Cliente cl WITH c.idcliente = cl.idcliente 
                    WHERE e.idempleado = :idempleado 
                    AND cl.idcliente = :idcliente 
                    AND c.fechacita = :fechacita"
                );

                $query->setParameter("idempleado",$info["idempleado"]);
                $query->setParameter("idcliente", $cliente->getIdcliente());
                $query->setParameter("fechacita", "$oFecha");

                $citas = $query->getResult();*/


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
                        $info["idcortesia"] != "" ? $nuevaCita->setIdcortesia($cortesia) : null;

                        $info["idlongitud"] != null ? $nuevaCita->setIdserviciolongitud($longitud) : null;

                        $em->persist($nuevaCita);
                        $flush = $em->flush();

                        if($flush == null){
                            $data = array(
                                "status"=>"success",
                                "data"=>"Cita registrada correctamente"
                            );
                        }else{
                            $data = array(
                                "status"=>"error",
                                "data"=>"Error al intentar registrar la cita"
                            );
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
                            $info["idcortesia"] != "" ? $nuevaCita->setIdcortesia($cortesia) : null;

                            $info["idlongitud"] != null ? $nuevaCita->setIdserviciolongitud($longitud) : null;

                            $em->persist($nuevaCita);
                            $flush = $em->flush();

                            if($flush == null){
                                $data = array(
                                    "status"=>"success",
                                    "data"=>"Cita registrada correctamente"
                                );
                            }else{
                                $data = array(
                                    "status"=>"error",
                                    "data"=>"Error al intentar registrar la cita"
                                );
                            }

                        }else{
                            $mensaje = "Ya tiene una cita registrada en ese horario con otro de nuestros colaboradores";
                            $data = array(
                                "status"=>"error",
                                "data"=>$mensaje
                            );
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
                            $info["idcortesia"] != "" ? $nuevaCita->setIdcortesia($cortesia) : null;

                            $info["idlongitud"] != null ? $nuevaCita->setIdserviciolongitud($longitud) : null;

                            $em->persist($nuevaCita);
                            $flush = $em->flush();

                            if($flush == null){
                                $data = array(
                                    "status"=>"success",
                                    "data"=>"Cita registrada correctamente"
                                );
                            }else{
                                $data = array(
                                    "status"=>"error",
                                    "data"=>"Error al intentar registrar la cita"
                                );
                            }

                        }else{
                            sort($arrHoras);
                            $arrOrdenado = end($arrHoras);
                            $arrHorario = explode("-",$arrOrdenado["horario"]);
                            $horaRecomendada = $arrHorario[1];
                            if($horaRecomendada >= "18:00"){
                                $mensaje = "¡Horario no disponible! Se le recomienda agendar su cita para el día ".$oFecha->modify('+1 day')->format("Y-m-d");
                            }else{
                                $mensaje = "¡Horario no disponible! Se le recomienda seleccionar el horario de las ".$horaRecomendada." para agendar su cita";
                            }
                            $data = array(
                                "status"=>"error",
                                "data"=>$mensaje
                            );
                        }
                    }else{
                        $data = array(
                            "status"=>"error",
                            "data"=>"No puede agendar dos citas para el mismo día"
                        );
                    }
                }
            }else{
                $data = array(
                    "status"=>"error",
                    "data"=>"El token no es válido"
                );
            }
        }else{
            $data = array(
                "status"=>"error",
                "data"=>"Faltan datos"
            );
        }
        return $helpers->json($data);
    }

    function validadorHoras($h1, $h2, $hSel){
        $horaDesde = \DateTime::createFromFormat('!H:i', $h1);
        $horaHasta = \DateTime::createFromFormat('!H:i', $h2);
        $horaSel = \DateTime::createFromFormat('!H:i', $hSel);
        if($horaDesde > $horaHasta) $horaHasta->modify('+1 day');
        return ($horaDesde <= $horaSel && $horaSel <= $horaHasta);
    }

    public function misCitasAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $helpers = $this->get(Helpers::class);

        $token = $request->get('token');
        $email = $request->get('email');

        if($token != "" && $email != ""){
            $jwt_auth = $this->get(JwtAuth::class);
            $tokenValido = $jwt_auth->checkToken($token);

            if($tokenValido){
                //Buscar los datos del cliente
                $cliente = $em->getRepository('LavandaBundle:Cliente')->findOneBy(array(
                    "email"=>$email
                ));

                //Buscar las citas del cliente
               /*$citas = $em->getRepository('LavandaBundle:Citas')->findBy(array(
                    "idcliente"=>$cliente->getIdcliente()
                ));*/

               $query = $em->createQuery(
                   "SELECT c FROM LavandaBundle:Citas c 
                   WHERE c.idcliente = :idcliente 
                   ORDER BY c.fechacita DESC"
               );

               $query->setParameter("idcliente",$cliente->getIdcliente());
               $citas = $query->getResult();

                $arrCitas = array();

                foreach ($citas as $cita){
                    $proceso = $em->getRepository('LavandaBundle:Procesos')->findOneBy(array(
                        "idcita" => $cita->getIdcita()
                    ));

                    array_push($arrCitas, [
                        "idcita"=>$cita->getIdcita(),
                        "empleado"=>$cita->getIdempleado()->getNombre()." ".$cita->getIdempleado()->getApellido(),
                        "servicio"=>$cita->getIdservicio()->getNombre(),
                        "fecha" => date_format($cita->getFechacita(),"d-m-Y"),
                        "horarioInicio" => date_format($cita->getHorarioinicio(), "H:i"),
                        "horarioFin" => date_format($cita->getHorariofin(), "H:i"),
                        "claveEstatus" => $cita->getIdestatus()->getClave(),
                        "estatus" => $cita->getIdestatus()->getDescripcion(),
                        "proceso" => $proceso != null ? "S" : "N"
                    ]);
                }

                //sort($arrCitas, 0);

                $data = array(
                    "status"=>"success",
                    "data"=>$arrCitas
                );

            }else{
                $data = array(
                    "status"=>"error",
                    "data"=>"El token no es válido"
                );
            }
        }else{
            $data = array(
                "status"=>"error",
                "data"=>"Faltan datos"
            );
        }
        return $helpers->json($data);
    }
}
