<?php

namespace LavandaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExpedienteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /*->add('rutafoto')
            ->add('nombrefoto')
            ->add('fecha')
            ->add('idcliente')*/
            ->add('files', FileType::class, array(
                "label" => "Seleccione las fotografías para el expediente",
                "attr" => array("class"=>"form-control"),
                "multiple" => true,
                "mapped" => false,
                "data_class" => null
            ))
            ->add('Guardar', SubmitType::class, array(
                "label" => "Cargar",
                "attr" => array("class"=> "form-submit btn btn-success")
            ))
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LavandaBundle\Entity\Expediente'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_expediente';
    }


}
