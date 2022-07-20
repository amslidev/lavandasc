<?php

namespace LavandaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CortesiaproductoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cantidad', NumberType::class, [
                "label" => "Ingrese la Cantidad",
                "attr" => array("class"=>"form-control")
            ])
            //->add('idcortesia')
            //->add('idproducto')
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
            'data_class' => 'LavandaBundle\Entity\Cortesiaproducto'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_cortesiaproducto';
    }


}
