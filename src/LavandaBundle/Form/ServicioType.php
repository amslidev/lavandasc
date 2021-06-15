<?php

namespace LavandaBundle\Form;

use KMS\FroalaEditorBundle\Form\Type\FroalaEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServicioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array(
                "label"=>"Ingrese el nombre del Servicio",
                "attr"=>array("class"=>"form-control")
            ))
            ->add('tiempo', NumberType::class, array(
                "label"=>"Ingrese el tiempo en minutos que dura el servicio",
                "attr"=>array("class"=>"form-control")
            ))
            ->add('precio', MoneyType::class, array(
                "label"=>"Ingrese el precio por onza",
                "divisor"=>1,
                "currency"=>"MXN",
                "attr"=>array("class"=>"form-control")
            ))
            ->add('descripcion', FroalaEditorType::class, array(
                "language" => "es",
                "toolbarInline" => false,
                "tableColors" => [ "#FFFFFF", "#FF0000" ],
                "label"=>"Ingrese la descripción del servicio"
            ))
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LavandaBundle\Entity\Servicio'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_servicio';
    }


}
