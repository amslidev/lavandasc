<?php

namespace LavandaBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CitasHoyCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('lavanda:citashoy')
            ->setDescription('Manda notificaciones a los clientes de sus próximas citas');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $fechaActual = date('Y-m-d');

        $query = $em->createQuery(
            "SELECT c FROM LavandaBundle:Citas c 
            WHERE c.fechacita = :fecha"
        );

        $query->setParameter("fecha", "$fechaActual");
        $citas = $query->getResult();

        foreach ($citas as $cita){
            $usuario = $cita->getIdcliente()->getIdusuario();

            $contenido = "Se le recuerda que tiene una cita el día de hoy con nosotros a las ". date_format($cita->getHorarioinicio(), "H:s");
            $contenido = $contenido. " para su servicio de ".$cita->getIdservicio()->getNombre();

            $notficacion = $this->getContainer()->get('arsc.notificacion_firebase_service');
            $notficacion->enviarNotificacion($usuario->getIdusuario(), "AR Salud Capilar ¡Nos vemos hoy!", $contenido);

            $correo = $this->getContainer()->get('arsc.notificacion_correo_service');
            $correo->enviarCorreo($cita->getIdcliente()->getIdcliente(), "AR Salud Capilar ¡Nos vemos hoy!", $contenido);
        }
    }
}
