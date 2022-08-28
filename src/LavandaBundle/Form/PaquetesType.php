<?php

namespace LavandaBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaquetesType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $cssClass = ["class"=>"form-control"];
        $builder
            ->add('idcliente', EntityType::class, [
                "label" => "Seleccione al cliente",
                "placeholder" => "Escriba el nombre del cliente",
                "attr" => ["class"=>"movies"],
                "class" => "LavandaBundle\Entity\Cliente",
                "query_builder" => function(EntityRepository $er){
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.apellido','ASC');
                },
                "choice_label" => function($cliente, $key, $index){
                    return $cliente->getNombre()." ".$cliente->getApellido()." (".$cliente->getTelefono().")";
                }
            ])
            ->add('idservicio', EntityType::class, [
                "label" => "Seleccione el servicio",
                "placeholder" => "Escriba el nombre del servicio",
                "attr" => ["class"=>"movies"],
                "class" => "LavandaBundle\Entity\Servicio",
                "query_builder" => function(EntityRepository $er){
                    return $er->createQueryBuilder('s')
                        ->orderBy('s.nombre', 'ASC');
                }
            ])
            ->add('cantidad', NumberType::class, [
                "label" => "Ingrese la Cantidad de sesiones del paquete",
                "attr" => $cssClass
            ])
            ->add('precio', MoneyType::class, [
                "label" => "Ingrese el precio del paquete",
                "currency" => "MXN",
                "attr" => $cssClass
            ])
            /*->add('fechainicio', DateType::class, [
                "label" => "Seleccione la fecha de inicio del paquete",
                "attr" => $cssClass,
                "widget" => "single_text"
            ])*/
            //->add('fechafin')
            ->add('Guardar', SubmitType::class, [
                "label" => "Guardar",
                "attr" => ["class"=>"form-submit btn btn-success"]
            ])
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LavandaBundle\Entity\Paquetes'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_paquetes';
    }


}
