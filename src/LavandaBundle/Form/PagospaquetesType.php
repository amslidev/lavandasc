<?php

namespace LavandaBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PagospaquetesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cantidadabonada', MoneyType::class, [
                "label" => "Ingrese la cantidad abonada",
                "currency" => "MXN",
                "attr" => ["class"=>"form-control"]
            ])
            //->add('fechapago')
            ->add('idformapago', EntityType::class, [
                "label" => "Seleccione la forma de Pago",
                "class" => "LavandaBundle\Entity\Formaspago",
                "placeholder" => "Seleccione un elemento",
                "attr" => ["class"=>"form-control"]
            ])
            //->add('idpaquete')
            ->add('Guardar', SubmitType::class, [
                "label"=>"Guardar",
                "attr" => ["class"=>"form-submit btn btn-success"]
            ])
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LavandaBundle\Entity\Pagospaquetes'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_pagospaquetes';
    }


}
