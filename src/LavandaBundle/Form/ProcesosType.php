<?php

namespace LavandaBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProcesosType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $ccsClass = array("class" => "form-control");

        $builder
            ->add('fechaproceso', DateType::class, array(
                "label" => "Fecha de proceso",
                "widget" => "single_text",
                "attr" => $ccsClass
            ))
            ->add('procedimiento', TextType::class, array(
                "label" => "Ingrese el nombre del procedimento",
                "attr" => $ccsClass
            ))
            ->add('productos', TextareaType::class, array(
                "label" => "Productos utlizados",
                "attr"=>array(
                    "class"=>"summernote",
                )
            ))
            ->add('comentarios', TextareaType::class, array(
                "label" => "Ingrese comentarios respecto al proceso",
                "attr"=>array(
                    "class"=>"summernote",
                )
            ))
            ->add('fotoantes', FileType::class, array(
                "label" => "Seleccione la foto del antes del proceso",
                "attr" => $ccsClass,
                "mapped" => false,
                "data_class" => null
            ))
            ->add('fotodespues', FileType::class, array(
                "label" => "Seleccione la foto del antes del proceso",
                "attr" => $ccsClass,
                "mapped" => false,
                "data_class" => null
            ))
            //->add('fechaproximacita')
            ->add('servicio', EntityType::class, array(
                "label" => "Servicio que se le realizará",
                "class" => "LavandaBundle\Entity\Servicio",
                "placeholder" =>"Seleccione un elemento",
                "mapped" => false,
                "data_class" => null,
                "attr" => $ccsClass
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
            ->add('sucursal', EntityType::class, array(
                "label" => "Sucursal donde será atendido el cliente",
                "class" => "LavandaBundle\Entity\Sucursal",
                "placeholder" =>"Seleccione un elemento",
                "mapped" => false,
                "data_class" => null,
                "attr" => $ccsClass,
                "query_builder" => function(EntityRepository $er){
                    return $er->createQueryBuilder('s')
                        ->where('s.activo = 1');
                }
            ))
            ->add('empleado', EntityType::class, array(
                "label" => "Empleado que lo atenderá",
                "class" => "LavandaBundle\Entity\Empleado",
                "placeholder" =>"Seleccione un elemento",
                "mapped" => false,
                "data_class" => null,
                "attr" => $ccsClass
            ))
            ->add('fechacita', DateType::class, array(
                "label" => "Seleccione la fecha para la próxima cita",
                "attr" => $ccsClass,
                "widget" => "single_text",
                "mapped" => false,
                "data_class" => null
            ))
            ->add('horacita', TimeType::class, array(
                "label" => "Seleccione la hora para la próxima cita",
                "attr" => $ccsClass,
                "widget" => "single_text",
                "mapped" => false,
                "data_class" => null
            ))
            //->add('idcita')
            ->add('Guardar', SubmitType::class, array(
                "attr" => array("class" => "form-submit btn btn-success")
            ))
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LavandaBundle\Entity\Procesos'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_procesos';
    }


}
