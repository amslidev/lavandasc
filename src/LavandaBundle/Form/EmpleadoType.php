<?php

namespace LavandaBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmpleadoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array(
                "label"=>"Nombre(s)",
                "attr"=>array("class"=>"form-control")
            ))
            ->add('apellido', TextType::class, array(
                "label"=>"Apellidos",
                "attr"=>array("class"=>"form-control")
            ))
            ->add('idsucursal', EntityType::class, array(
                "label" => "Sucursal a la que pertenece",
                "class" => "LavandaBundle\Entity\Sucursal",
                "placeholder" => "Seleccione un elemento",
                "attr" => array("class" => "form-control"),
                "query_builder" => function(EntityRepository $er){
                    return $er->createQueryBuilder('s')
                        ->where('s.activo = 1');
                }
            ))
            ->add('direccion', TextareaType::class, array(
                "label"=>"Ingrese la dirección",
                "attr"=>array("class"=>"form-control"),
                "required"=>false
            ))
            ->add('telefono', TextType::class, array(
                "label"=>"Ingrese el teléfono",
                "attr"=>array("class"=>"form-control", "maxlength"=>10)
            ))
            ->add('rfc', TextType::class, array(
                "label"=>"Ingrese el RFC del empleado",
                "attr"=>array("class"=>"form-control","maxlength"=>"13"),
                "required"=>false
            ))
            ->add('curp', TextType::class, array(
                "label"=>"Ingrese la CURP",
                "attr"=>array("class"=>"form-control","maxlength"=>"19"),
                "required"=>false
            ))
            //->add('fecharegistro')
            //->add('fechabaja')
            ->add('imagen', FileType::class, array(
                "label"=>"Seleccione una foto del empleado",
                "attr"=>array("class"=>"form-control"),
                "mapped"=>false,
                "data_class"=>null,
                "required"=>false
            ))
            ->add('activo', CheckboxType::class, array(
                "label"=>"¿El empleado está activo?",
                "attr"=>array("class"=>"form-control"),
                "required"=>false
            ))
            ->add('Guardar',SubmitType::class, array(
                "label" => "Guardar",
                "attr"=>array("class"=>"form-submit btn btn-success")
            ))
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LavandaBundle\Entity\Empleado'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_empleado';
    }


}
