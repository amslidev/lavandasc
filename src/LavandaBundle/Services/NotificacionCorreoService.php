<?php

namespace LavandaBundle\Services;

use LavandaBundle\Entity\Cliente;
use LavandaBundle\Entity\Contacto;

class NotificacionCorreoService
{

    public $em;

    public function __construct($manager)
    {
        $this->em = $manager;

    }

    public function enviarCorreo($idusuario, $titulo, $mensaje){
        $em = $this->em;
        $cliente = $em->getRepository('LavandaBundle:Cliente')->find($idusuario);
        $this->enviarMailCliente($titulo, $mensaje, $cliente);
    }

    public function enviarMailCliente($titulo, $mensaje, Cliente $cliente){
        $em = $this->em;

        //Enviar correo
        $globales = $em->getRepository('LavandaBundle:Globales');

        $server = $globales->findOneBy(array("clave" => "SMTPG"))->getValor();
        $port = $globales->findOneBy(array("clave" => "PORTS"))->getValor();
        $user = $globales->findOneBy(array("clave" => "MAIL"))->getValor();
        $pwd = $globales->findOneBy(array("clave" => "PWD"))->getValor();

        $transport = \Swift_SmtpTransport::newInstance($server, $port, 'tls')
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
                                                    <b>'.$titulo.'</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 20px 0 30px 0; color: #D4AF37; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                                    <p>'. $mensaje .' </p>
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
                                                                <a href="https://www.facebook.com/arsaludcapilar" style="color: #ffffff;">
                                                                    <img src="https://cdn-icons-png.flaticon.com/512/1051/1051360.png" alt="Twitter" width="38" height="38" style="display: block; color: white" border="0" />
                                                                </a>
                                                            </td>
                                                            <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                                                            <td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold; color: #D4AF37;">
                                                                <a href="https://www.instagram.com/arsaludcapilar/" style="color: #ffffff;">
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

        $subjet = "¡Notificación de cita para ". $cliente->getNombre(). " " . $cliente->getApellido(). "!";
        $text = $html;
        $mensaje = (new \Swift_Message())
            ->setSubject($subjet)
            ->setFrom([$user => 'AR Salud Capilar'])
            ->setTo([$cliente->getEmail() => $cliente->getEmail()])
            ->setBody($text, 'text/html');
        $mailer->send($mensaje);
    }

    public function enviarMailContactoAnonimo(Contacto $contacto){
        $em = $this->em;

        $sucursal = $contacto->getIdsucursal();

        //Enviar correo
        $globales = $em->getRepository('LavandaBundle:Globales');

        $server = $globales->findOneBy(array("clave" => "SMTPG"))->getValor();
        $port = $globales->findOneBy(array("clave" => "PORTS"))->getValor();
        $user = $globales->findOneBy(array("clave" => "MAIL"))->getValor();
        $pwd = $globales->findOneBy(array("clave" => "PWD"))->getValor();

        $transport = \Swift_SmtpTransport::newInstance($server, $port, 'tls')
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
                                                    <b>'.$contacto->getNombre().' '. $contacto->getApellido(). ' quiere ponerse en contacto con nosotros</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 20px 0 30px 0; color: #D4AF37; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
                                                    <p> Teléfono: '. $contacto->getTelefono() .' </p>
                                                    <p> Email '. $contacto->getEmail() .' </p>
                                                    <label for="txtcomentarios">Comentarios</label>
                                                    <textarea name="txtcomentarios" rows="10" cols="5">'.$contacto->getComentarios().'</textarea>
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
                                                                <a href="https://www.facebook.com/arsaludcapilar" style="color: #ffffff;">
                                                                    <img src="https://cdn-icons-png.flaticon.com/512/1051/1051360.png" alt="Twitter" width="38" height="38" style="display: block; color: white" border="0" />
                                                                </a>
                                                            </td>
                                                            <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                                                            <td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold; color: #D4AF37;">
                                                                <a href="https://www.instagram.com/arsaludcapilar/" style="color: #ffffff;">
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

        $subjet = "¡".$contacto->getNombre()." ".$contacto->getApellido()." quiere contactarse con el salón de ".$contacto->getIdsucursal()->getNombre()."!";
        $text = $html;
        $mensaje = (new \Swift_Message())
            ->setSubject($subjet)
            ->setFrom([$user => 'AR Salud Capilar'])
            ->setTo([$sucursal->getEmail() => $sucursal->getEmail()])
            ->setBody($text, 'text/html');
        $mailer->send($mensaje);
    }

    public function enviarCorreoRegistro(Cliente  $cliente, $usuario, $pass){
        $em = $this->em;

        //Enviar correo
        $globales = $em->getRepository('LavandaBundle:Globales');

        $server = $globales->findOneBy(array("clave" => "SMTPG"))->getValor();
        $port = $globales->findOneBy(array("clave" => "PORTS"))->getValor();
        $user = $globales->findOneBy(array("clave" => "MAIL"))->getValor();
        $pwd = $globales->findOneBy(array("clave" => "PWD"))->getValor();

        $transport = \Swift_SmtpTransport::newInstance($server, $port, 'tls')
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
                                                    <p> Bienvenido a la familia AR Salud Capilar </p>
                                                    <p> Su nombre de usuario es: '. $usuario .' </p>
                                                    <p> Su Contraseña es: '. $pass .' . Guárdela en un lugar seguro</p>
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
                                                                <a href="https://www.facebook.com/arsaludcapilar" style="color: #ffffff;">
                                                                    <img src="https://cdn-icons-png.flaticon.com/512/1051/1051360.png" alt="Twitter" width="38" height="38" style="display: block; color: white" border="0" />
                                                                </a>
                                                            </td>
                                                            <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                                                            <td style="font-family: Arial, sans-serif; font-size: 12px; font-weight: bold; color: #D4AF37;">
                                                                <a href="https://www.instagram.com/arsaludcapilar/" style="color: #ffffff;">
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
}