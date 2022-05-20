<?php

namespace LavandaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class, array(
                "label" => "Ingrese el nombre de usuario",
                "attr" => array("class"=>"form-control")
            ) )
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
            ))
            ->add('role', ChoiceType::class, array(
                "label" => "Selecciona el perfil de usuario",
                "placeholder"=> "Seleccione una opción",
                "choices" => [
                    "Administrador"=>"ROLE_ADMIN",
                    "Usuario"=>"ROLE_USER"
                ],
                "attr" => array("class"=>"form-control")
            ))
            ->add('foto', FileType::class, array(
                "label" => "Seleccione la foto del usuario",
                "attr" => array("class"=>"form-control"),
                "data_class"=>null,
                "mapped"=>false,
                "required"=>false
            ))
            ->add('Guardar', SubmitType::class, array(
                "label"=>"Guardar",
                "attr"=> array("class"=>"form-submit btn btn-success")
            ))
            //->add('createdAt')
            //->add('isactive')
            //->add('rutaimagen')
            //->add('nombreimagen')
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LavandaBundle\Entity\Usuario'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_usuario';
    }


}
