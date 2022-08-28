<?php

namespace LavandaBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Citas2Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $ccsClass = array("class" => "form-control");

        $builder
            //->add('fechacita')
            //->add('horarioinicio')
            //->add('horariofin')
            ->add('idcliente', EntityType::class, array(
                "label" => "Seleccione un cliente",
                "class" => "LavandaBundle\Entity\Cliente",
                "placeholder" => "Seleccione un elemento",
                "query_builder" => function(EntityRepository $er){
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.nombre', 'ASC');
                },
                "choice_label" => function($cliente, $key, $index){
                    return $cliente->getNombre(). " ".$cliente->getApellido(). " - " . $cliente->getTelefono();
                },
                "attr" => array("class" => "form-control")
            ))
            ->add('servicio', EntityType::class, array(
                "label" => "Servicio que se le realizará",
                "class" => "LavandaBundle\Entity\Servicio",
                "placeholder" =>"Seleccione un elemento",
                "mapped" => false,
                "data_class" => null,
                "attr" => $ccsClass,
            ))
            ->add('idserviciolongitud', EntityType::class, array(
                "label" => "Longitud del cabello",
                "class" => "LavandaBundle\Entity\Serviciolongitud",
                "placeholder" => "Seleccione un elemento",
                "mapped" => false,
                "data_class" => null,
                "attr" => $ccsClass,
                "required" => false
            ))
            ->add('idsucursal', EntityType::class, array(
                "label" => "Seleccione la sucursal",
                "placeholder" => "Seleccione un elemento",
                "class" => "LavandaBundle\Entity\Sucursal",
                "query_builder" => function(EntityRepository $er){
                    return $er->createQueryBuilder('s')
                        ->where('s.activo = 1');
                },
                "attr" => array("class" => "form-control")
            ))
            ->add('idempleado', EntityType::class, array(
                "label"=>"Seleccione al colaborador",
                "placeholder"=>"Seleccione un elemento",
                "class"=>"LavandaBundle\Entity\Empleado",
                "query_builder"=> function(EntityRepository $er){
                    return $er->createQueryBuilder('e')
                        ->where('e.activo = 1')
                        ->orderBy('e.nombre', 'ASC');
                },
                "choice_label"=>function($empleado, $key, $index){
                    return $empleado->getNombre()." ".$empleado->getApellido();
                },
                "attr"=>array("class"=>"form-control")
            ))
            ->add('fechacita', DateType::class, array(
                "label" => "Seleccione la fecha de la cita",
                "attr" => $ccsClass,
                "widget" => "single_text",
                "mapped" => false,
                "data_class" => null
            ))
            ->add('horacita', TimeType::class, array(
                "label" => "Seleccione la hora de la cita",
                "attr" => $ccsClass,
                "widget" => "choice",
                "mapped" => false,
                "data_class" => null,
                "hours" => ["09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19"]
            ))
            ->add('comentarios', TextareaType::class, [
                "label" => "Aquí puede ingresar notas de la cita",
                "attr"=>array(
                    "class"=>"summernote",
                )
            ])
            /*->add('idcortesia', EntityType::class, array(
                "label" => "Seleccione la cortesía",
                "placeholder" => "Seleccione un elemento",
                "class" => "LavandaBundle\Entity\Cortesias",
                "attr" => $ccsClass,
                "query_builder" => function(EntityRepository $er){
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.nombre', 'ASC');
                }
            ))*/
            /*->add('Guardar', SubmitType::class, array(
                "attr" => array("class" => "form-submit btn btn-success")
            ))*/

            //->add('idestatus')
            //->add('idservicio')
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LavandaBundle\Entity\Citas'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_citas';
    }


}
