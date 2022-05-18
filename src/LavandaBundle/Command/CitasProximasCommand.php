<?php

namespace LavandaBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CitasProximasCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('lavanda:citasproximas')
            ->setDescription('Manda notificaciones a los clientes de sus próximas citas');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $fechaActual = date('Y-m-d');
        $nuevaFecha = strtotime('+1 day', strtotime($fechaActual));
        $nuevaFecha = date('Y-m-d', $nuevaFecha);

        $query = $em->createQuery(
            "SELECT c FROM LavandaBundle:Citas c 
            WHERE c.fechacita = :fecha"
        );

        $query->setParameter("fecha", "$nuevaFecha");
        $citas = $query->getResult();

        foreach ($citas as $cita){
            $usuario = $cita->getIdcliente()->getIdusuario();

            $contenido = "Se le recuerda que tiene una cita con nosotros el día de mañana ".date_format($cita->getFechacita(), "d-m-Y"). " a las ". date_format($cita->getHorarioinicio(), "H:i");
            $contenido = $contenido. " para su servicio de ".$cita->getIdservicio()->getNombre();

            $notficacion = $this->getContainer()->get('arsc.notificacion_firebase_service');
            $notficacion->enviarNotificacion($usuario->getIdusuario(), "AR Salud Capilar ¡Nos vemos mañana!", $contenido);

            $correo = $this->getContainer()->get('arsc.notificacion_correo_service');
            $correo->enviarCorreo($cita->getIdcliente()->getIdcliente(), "AR Salud Capilar ¡Nos vemos mañana!", $contenido);
        }
    }
}
