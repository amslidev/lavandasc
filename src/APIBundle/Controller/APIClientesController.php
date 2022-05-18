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

                    $jwt_auth = $this->get(JwtAuth::class);
                    $signup = $jwt_auth->signup($nombreUsuario, $password);

                    if($signup["data"] != "404"){
                        $cliente = $em->getRepository('LavandaBundle:Cliente')->findOneBy(array(
                            "idusuario" => $usuario->getIdusuario()
                        ));

                        if($cliente != null){
                            $encuesta = $em->getRepository('LavandaBundle:Encuesta')->findOneBy(array(
                                "idcliente" => $cliente->getIdcliente()
                            ));

                            $flag = ($encuesta != null) ? "S" : "N";

                            $data = array(
                                "status" => "success",
                                "data" => $signup,
                                "cliente" => $cliente,
                                "encuesta" => $flag
                            );

                            $this->enviarCorreo($cliente);
                        }else{
                            $data = array(
                                "status" => "error",
                                "data" => "No es encontró información del cliente"
                            );
                        }
                    }else{
                        $data = array(
                            "status" => "error",
                            "data" => "Datos de usuario incorrectos"
                        );
                    }
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

    public function enviarCorreo(Cliente $cliente){
        $em = $this->getDoctrine()->getManager();

        //Enviar correo
        $globales = $em->getRepository('LavandaBundle:Globales');

        $server = $globales->findOneBy(array("clave" => "SMTPG"))->getValor();
        $port = $globales->findOneBy(array("clave" => "PORTS"))->getValor();
        $user = $globales->findOneBy(array("clave" => "MAIL"))->getValor();
        $pwd = $globales->findOneBy(array("clave" => "PWD"))->getValor();

        $transport = \Swift_SmtpTransport::newInstance($server, $port, 'ssl')
            ->setSourceIp('0.0.0.0')
            ->setUsername($user)
            ->setPassword($pwd);

        $mailer = \Swift_Mailer::newInstance($transport);

        $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>AR Salud Capilar</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            </head>
            <body style="margin: 0; padding: 0;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%">	
                    <tr>
                        <td style="padding: 10px 0 30px 0;">
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
                                <tr>
                                    <td align="center" bgcolor="grey" style="padding: 40px 0 30px 0; color: #153643; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
                                        <img src="https://arsaludcapilar.com/web/uploads/empresa/logo/logo.png" alt="AR Salud Capilar" width="300" height="230" style="display: block;" />
                                    </td>
                                </tr>
                                <tr>
                                    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td style="color: #D4AF37; font-family: Arial, sans-serif; font-size: 24px;">
                                                    <b>AR SALUD CAPILAR</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 20px 0 30px 0; color: #D4AF37; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                                    <p> Bienvenido a la familia AR Salud Capilar estimada/o '. $cliente->getNombre() .', acaba de iniciar sesión en un nuevo dispositivo </p>
                                                    <p> Su nombre de usuario es: '. $cliente->getIdusuario()->getUsername() .' </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td bgcolor="grey" style="padding: 30px 30px 30px 30px;">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td style="color: #D4AF37; font-family: Arial, sans-serif; font-size: 14px;" width="75%">
                                                    &reg; AR Salud Capilar<br/>
                                                </td>
                                                <td align="right" width="25%">
                                                    <table border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold; color: #D4AF37;">
                                                                <a href="https://www.facebook.com/Salud-Capilar-AR-111173238052024/" style="color: #ffffff;">
                                                                    <img src="https://cdn-icons-png.flaticon.com/512/1051/1051360.png" alt="Twitter" width="38" height="38" style="display: block; color: white" border="0" />
                                                                </a>
                                                            </td>
                                                            <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                                                            <td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold; color: #D4AF37;">
                                                                <a href="https://www.facebook.com/Salud-Capilar-AR-111173238052024/" style="color: #ffffff;">
                                                                    <img src="https://cdn-icons-png.flaticon.com/512/1077/1077042.png" alt="Facebook" width="38" height="38" style="display: block; color: white" border="0" />
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            
            
            </body>
            </html>';

        $subjet = "¡Notificación de actividad del cliente ". $cliente->getNombre(). " " . $cliente->getApellido(). "!";
        $text = $html;
        $mensaje = (new \Swift_Message())
            ->setSubject($subjet)
            ->setFrom([$user => 'AR Salud Capilar'])
            ->setTo([$cliente->getEmail() => $cliente->getEmail()])
            ->setBody($text, 'text/html');
        $mailer->send($mensaje);
        
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

                        if($cliente != null){
                            $encuesta = $em->getRepository('LavandaBundle:Encuesta')->findOneBy(array(
                                "idcliente" => $cliente->getIdcliente()
                            ));

                            $flag = ($encuesta != null) ? "S" : "N";

                            $data = array(
                                "status" => "success",
                                "data" => $signup,
                                "cliente" => $cliente,
                                "encuesta" => $flag
                            );

                            $this->enviarCorreo($cliente);
                        }else{
                            $data = array(
                                "status" => "error",
                                "data" => "No es encontró información del cliente"
                            );
                        }
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
