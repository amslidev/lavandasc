<?php

namespace LavandaBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BodegasType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, [
                "label" => "Nombre",
                "attr" => array("class"=>"form-control")
            ])
            ->add('estado', CheckboxType::class, [
                "label" => "¿La bodega se encuentra habilitada?",
                "attr" => array("class"=>"form-control")
            ])
            ->add('idsucursal', EntityType::class, [
                "label" => "Seleccione la sucursal a la que está asignada la bodega",
                "placeholder" => "Seleccione un elemento",
                "class" => "LavandaBundle\Entity\Sucursal",
                "attr" => array("class"=>"form-control"),
                "query_builder" => function(EntityRepository  $er){
                    return $er->createQueryBuilder('s')
                        ->where('s.activo = 1');
                }
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
            'data_class' => 'LavandaBundle\Entity\Bodegas'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_bodegas';
    }


}
