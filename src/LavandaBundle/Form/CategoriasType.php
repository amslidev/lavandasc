<?php

namespace LavandaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriasType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, [
                "label" => "Nombre",
                "attr" => array("class" => "form-control")
            ])
            ->add('descripcion', TextType::class, [
                "label" => "Descripción",
                "attr" => array("class" => "form-control")
            ])
            ->add('Guardar', SubmitType::class, [
                "attr" => array("class" => "form-submit btn btn-success")
            ])
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LavandaBundle\Entity\Categorias'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_categorias';
    }


}
