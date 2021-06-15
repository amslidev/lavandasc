<?php

namespace LavandaBundle\Form;

use KMS\FroalaEditorBundle\Form\Type\FroalaEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmpresaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('razonsocial', TextType::class, array(
                "label"=>"Razón social",
                "attr"=>array("class"=>"form-control text-uppercase")
            ))
            ->add('direccionfiscal', TextType::class, array(
                "label"=>"Dirección fiscal",
                "attr"=>array("class"=>"form-control"),
                "required"=>false
            ))
            ->add('representante', TextType::class, array(
                "label"=>"Representante legal",
                "attr"=>array("class"=>"form-control"),
                "required"=>false
            ))
            ->add('telefonorepresentante', TextType::class, array(
                "label"=>"Teléfono del representate legal",
                "attr"=>array("class"=>"form-control", "maxlength"=>"10"),
                "required"=>false
            ))
            ->add('rfc', TextType::class, array(
                "label"=>"R.F.C",
                "attr"=>array("class"=>"form-control text-uppercase"),
                "required"=>false
            ))
            //->add('rutalogo')
            //->add('nombrelogo')
            ->add('logo', FileType::class, array(
                "label"=>"Seleccione el logo de la empresa",
                "attr"=>array("class"=>"form-control"),
                "mapped"=>false,
                "data_class"=>null,
                "required"=>false
            ))
            ->add('mision',FroalaEditorType::class, array(
                "language" => "es",
                "toolbarInline" => false,
                "tableColors" => [ "#FFFFFF", "#FF0000" ],
                "label"=>"Misión",
                "required"=>false
            ) )
            ->add('vision', FroalaEditorType::class, array(
                "language" => "es",
                "toolbarInline" => false,
                "tableColors" => [ "#FFFFFF", "#FF0000" ],
                "label"=>"Visión",
                "required"=>false
            ))
            ->add('valores', FroalaEditorType::class, array(
                "language" => "es",
                "toolbarInline" => false,
                "tableColors" => [ "#FFFFFF", "#FF0000" ],
                "label"=>"Valores",
                "required"=>false
            ))
            ->add('Guardar', SubmitType::class, array(
                "label"=>"Guardar",
                "attr"=>array("class"=>"form-submit btn btn-success")
            ))
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LavandaBundle\Entity\Empresa'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_empresa';
    }


}
