<?php

namespace LavandaBundle\Services;

use LavandaBundle\Entity\Barventa;
use LavandaBundle\Entity\Citas;
use LavandaBundle\Entity\Detallebarventa;

class ActualizarStockService
{
    public $em;

    public function __construct($manager)
    {
        $this->em = $manager;
    }

    public function actualizarStockServicios(Citas $cita){
        $em = $this->em;
        //Obtener el servicio realizado
        $servicio = $cita->getIdservicio();

        //Buscar todos los productos asociados al servicio para descontarles la cantidad del stock
        $servicioproducto = $em->getRepository('LavandaBundle:Servicioproducto')->findBy([
            "idservicio" => $servicio->getIdservicio()
        ]);

        foreach ($servicioproducto as $item){
            //Obtener la cantidad utilizada por el producto
            $producto = $item->getIdproducto();
            $cantidad = $item->getCantidad();

            //Obtener el stock actual del producto
            $stock = $producto->getStock();
            $nuevoStock = $stock - $cantidad;
            $producto->setStock($nuevoStock);

            $em->persist($producto);
            $em->flush();
        }
    }

    public function decrementarStockBar(Detallebarventa $detalle, $cantidad){
        $em = $this->em;

        //Obtener los datos de la cortesía vendida
        $cortesia = $detalle->getIdcortesia();

        //Buscar todos los productos asociados a la cortesía para descontarles la cantidad del stock
        $cortesiaproducto = $em->getRepository('LavandaBundle:Cortesiaproducto')->findBy([
            "idcortesia" => $cortesia->getIdcortesia()
        ]);

        foreach ($cortesiaproducto as $item){
            for ($i = 0; $i < $cantidad; $i++){
                //Obtener la cantidad utilizada por el producto
                $producto = $item->getIdproducto();
                $cantidadUtilizada = $item->getCantidad();

                //Obtener el stock actual del producto
                $stock = $producto->getStock();
                $nuevoStock = $stock - $cantidadUtilizada;
                $producto->setStock($nuevoStock);

                $em->persist($producto);
                $em->flush();
            }

        }
    }

    public function incrementarStockBar(Detallebarventa $detalle, $cantidad){
        $em = $this->em;

        //Obtener los datos de la cortesía vendida
        $cortesia = $detalle->getIdcortesia();

        //Buscar todos los productos asociados a la cortesía para descontarles la cantidad del stock
        $cortesiaproducto = $em->getRepository('LavandaBundle:Cortesiaproducto')->findBy([
            "idcortesia" => $cortesia->getIdcortesia()
        ]);

        foreach ($cortesiaproducto as $item){
            for ($i = 0; $i < $cantidad; $i++){
                //Obtener la cantidad utilizada por el producto
                $producto = $item->getIdproducto();
                $cantidadUtilizada = $item->getCantidad();

                //Obtener el stock actual del producto
                $stock = $producto->getStock();
                $nuevoStock = $stock + $cantidadUtilizada;
                $producto->setStock($nuevoStock);

                $em->persist($producto);
                $em->flush();
            }

        }
    }

}