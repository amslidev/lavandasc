<?php

namespace LavandaBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComprasproductoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idproducto', EntityType::class, [
                "label" => "Seleccione el producto",
                "placeholder" => "Seleccione un elemento",
                "class" => "LavandaBundle\Entity\Producto",
                "attr" => array("class" => "form-control"),
                "choice_label" => function($producto, $key, $index){
                    return $producto->getNombre()." (".$producto->getUnidadmedida()->getNombre().")";
                }
            ])
            ->add('idproveedor', EntityType::class, [
                "label" => "Seleccione el proveedor",
                "placeholder" => "Seleccione un elemento",
                "class" => "LavandaBundle\Entity\Proveedor",
                "attr" => array("class" => "form-control")
            ])
            ->add('cantidad', NumberType::class, [
                "label" => "Ingrese la cantidad comprada",
                "attr" => array("class" => "form-control")
            ])
            ->add('precio', MoneyType::class, [
                "label" => "Ingrese la cantidad pagada",
                "currency" => "MXN",
                "attr" => array("class" => "form-control")
            ])
            ->add('pdf', FileType::class, [
                "label" => "Seleccione el archivo PDF",
                "attr" => array("class"=>"form-control"),
                "data_class" => null,
                "mapped" => false
            ])
            ->add('xml', FileType::class, [
                "label" => "Seleccione el archivo XML",
                "attr" => array("class"=>"form-control"),
                "data_class" => null,
                "mapped" => false,
                "required" => false
            ])
            ->add('Guardar', SubmitType::class, [
                "attr" => array("class" => "form-submit btn btn-success")
            ])
            //->add('fecha')
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LavandaBundle\Entity\Comprasproducto'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_comprasproducto';
    }


}
