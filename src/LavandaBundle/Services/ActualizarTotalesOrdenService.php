<?php

namespace LavandaBundle\Services;

class ActualizarTotalesOrdenService
{
    public $em;

    public function __construct($manager)
    {
        $this->em = $manager;
    }

    public function actualizarTotales($idorden)
    {
        $em = $this->em;

        $orden = $em->getRepository('LavandaBundle:Barventa')->find($idorden);

        //Obtener el descuento
        $descuento = $orden->getDescuento();

        $detalles = $em->getRepository('LavandaBundle:Detallebarventa')->findBy([
            "idbarventa" => $orden->getIdbarventa()
        ]);

        $suma = 0;
        $total = 0;
        foreach ($detalles as $detalle){
            $suma = $suma + $detalle->getSubtotal();
        }

        if($descuento == 0){
            $total = $suma;
            $orden->setTotal($total);
        }else{
            $descuentoOrden = round(($suma * $descuento)) / 100;
            $total = $suma - $descuentoOrden;
            $orden->setTotal($total);
        }

        $em->persist($orden);
        $em->flush();

    }
}