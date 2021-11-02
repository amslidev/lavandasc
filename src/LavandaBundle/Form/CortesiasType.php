<?php

namespace LavandaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CortesiasType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array(
                "label"=>"Nombre de la cortesía",
                "attr"=>array("class"=>"form-control")
            ))
            ->add('descripcion', TextType::class, array(
                "label"=>"Descripción de la cortesía",
                "attr"=>array("class"=>"form-control")
            ))
            /*->add('disponible')
            ->add('fechaingreso')
            ->add('fechasalida')
            ->add('rutaimagen')
            ->add('nombreimagen')*/
            ->add('foto', FileType::class, array(
                "label"=>"Seleccione la imagen de la cortesía",
                "attr"=>array("class"=>"form-control"),
                "mapped"=>false,
                "data_class"=>null
            ))
            ->add('Guardar',SubmitType::class, array(
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
            'data_class' => 'LavandaBundle\Entity\Cortesias'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_cortesias';
    }


}
