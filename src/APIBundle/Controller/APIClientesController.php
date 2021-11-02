<?php

namespace APIBundle\Controller;

use APIBundle\Services\Helpers;
use APIBundle\Services\JwtAuth;
use LavandaBundle\Entity\Cliente;
use LavandaBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class APIClientesController extends Controller
{
    public function newAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $helpers = $this->get(Helpers::class);

        $datos_cliente = $request->request->get('cliente');

        $data = array(
            'status' => 'error',
            'data' => 'Send json valid'
        );

        if($datos_cliente != null){
            $info = json_decode($datos_cliente, true);

            //Validar si el correo y el número de teléfono ya están datos de alta
            $email = $info["email"];

            //Datos para el usuario
            $nombreUsuario = $info["nombreUsuario"];
            $password = $info["password"];

            $registroCliente = $em->getRepository('LavandaBundle:Cliente')->findOneBy(array(
                "email"=>$email
            ));

            $user = $em->getRepository('LavandaBundle:Usuario')->findOneBy(array(
                "username" => $nombreUsuario
            ));

            if($registroCliente == null && $user == null){
                $cliente = new Cliente();
                $cliente->setNombre($info["nombre"]);
                $cliente->setApellido($info["apellido"]);
                $cliente->setDireccion($info["direccion"]);
                $cliente->setTelefono($info["telefono"]);
                $cliente->setEmail($info["email"]);
                $fechaNacimiento = new \DateTime($info["fechaNacimiento"]);
                $cliente->setFechanacimiento($fechaNacimiento);

                //Registrar al usuario
                $usuario = new Usuario();
                $usuario->setUsername($nombreUsuario);
                $usuario->setRole("ROLE_CLIENTE");
                $factory = $this->get('security.encoder_factory');
                $encoder = $factory->getEncoder($usuario);
                $passwordCifrada = $encoder->encodePassword($password, $usuario->getSalt());
                $usuario->setPassword($passwordCifrada);

                $usuario->setCreatedAt(new \DateTime("now"));
                $usuario->setIsactive(true);

                $cliente->setIdusuario($usuario);

                $em->persist($cliente);
                $em->persist($usuario);

                $flush = $em->flush();

                if($flush == null){
                    $data = array(
                        'status' => 'success',
                        'data' => 'Cliente registrado correctamente'
                    );
                }else{
                    $data = array(
                        'status' => 'error',
                        'data' => 'Error al intentar registrar al cliente'
                    );
                }
            }else{
                $data = array(
                    'status' => 'error',
                    'data' => 'Ya existe un usuario con estos datos'
                );
            }
        }else{
            $data = array(
                'status' => 'error',
                'data' => 'Faltan datos'
            );
        }

        return $helpers->json($data);
    }

    public function loginAction(Request $request){
        $em = $this->getDoctrine()->getManager();

        $helpers = $this->get(Helpers::class);

        $json = $request->request->get('data');

        $data = array(
            "status" => "error",
            "data" => "Send json valid"
        );

        if($json != null){
            $params = json_decode($json);
            $username = (isset($params->username)) ? $params->username : null;
            $password = (isset($params->password)) ? $params->password : null;

            $user = $em->getRepository('LavandaBundle:Usuario')->findOneBy(array(
                "username" => $username
            ));

            if($user != null && $user->getRole() == "ROLE_CLIENTE"){
                if($username != null && $password != null){
                    $jwt_auth = $this->get(JwtAuth::class);
                    $signup = $jwt_auth->signup($username, $password);

                    if($signup["data"] != "404"){
                        $cliente = $em->getRepository('LavandaBundle:Cliente')->findOneBy(array(
                            "idusuario" => $user->getIdusuario()
                        ));
                        $data = array(
                            "status" => "success",
                            "data" => $signup,
                            "cliente" => $cliente
                        );
                    }else{
                        $data = array(
                            "status" => "error",
                            "data" => "Datos de usuario incorrectos"
                        );
                    }
                }else{
                    $data = array(
                        "status" => "error",
                        "data" => "No se encontró información del usuario"
                    );
                }
            }else if($user != null && $user->getRole() != "ROLE_CLIENTE"){
                $data = array(
                    "status" => "error",
                    "data" => "Este acceso es sólo para clientes"
                );
            }else{
                $data = array(
                    "status" => "error",
                    "data" => "No se encontró información del usuario"
                );
            }
        }else{
            $data = array(
                "status" => "error",
                "data" => "El json no tiene un formato válido"
            );
        }

        return $helpers->json($data);
    }
}
