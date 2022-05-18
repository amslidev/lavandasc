<?php

namespace LavandaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SucursalType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array(
                "label" => "Nombre de la Sucursal",
                "attr" => array("class"=>"form-control")
            ))
            ->add('direccion', TextareaType::class, array(
                "label" => "Dirección de la sucursal",
                "attr" => array("class" => "form-control")
            ))
            ->add('activo', CheckboxType::class, array(
                "label" => "¿Está activa?",
                "attr" => array("class"=>"form-control"),
                "required" => false
            ))
            ->add('email', EmailType::class, array(
                "label" => "Email de recepción de la sucursal",
                "attr" => array("class"=>"form-control")
            ))
            ->add('Guardar', SubmitType::class, array(
                "attr" => array("class"=>"form-submit btn btn-success")
            ))
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LavandaBundle\Entity\Sucursal'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_sucursal';
    }


}
