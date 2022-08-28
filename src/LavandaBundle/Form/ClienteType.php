<?php

namespace LavandaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClienteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $cssClas = array("class" => "form-control");

        $builder
            ->add('nombre', TextType::class, array(
                "label" => "Nombre del Cliente",
                "attr" => $cssClas
            ))
            ->add('apellido', TextType::class, array(
                "label" => "Apellido del Cliente",
                "attr" => $cssClas
            ))
            /*->add('direccion', TextareaType::class, array(
                "label" => "Dirección",
                "attr" => $cssClas,
                "required" => false
            ))*/
            ->add('telefono', TextType::class, array(
                "label" => "Teléfono",
                "attr" => $cssClas,
                "required" => false
            ))
            /* ->add('email', EmailType::class, array(
                 "label" => "Email",
                 "attr" => $cssClas
             ))*/
             ->add('fechanacimiento', DateType::class, array(
                 "label" => "Fecha de nacimiento",
                 "widget" => "single_text",
                 "attr" => $cssClas,
                "required" => false
             ))
            /*->add('username',TextType::class, array(
                "label" => "Ingrese el nombre de usuario",
                "attr" => array("class"=>"form-control"),
                "mapped" => false,
                "data_class" => null
            ))
            ->add('password', RepeatedType::class, array(
                "type"=>PasswordType::class,
                "mapped"=>false,
                "data_class"=>null,
                "first_options"=>array(
                    "label"=>"Ingrese la contraseña",
                    "attr"=>array("class"=>"form-control")
                ),
                "second_options"=>array(
                    "label"=>"Confirmar contraseña",
                    "attr"=>array("class"=>"form-control")
                ),
                "required"=>false
            ))*/
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
            'data_class' => 'LavandaBundle\Entity\Cliente'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_cliente';
    }


}
