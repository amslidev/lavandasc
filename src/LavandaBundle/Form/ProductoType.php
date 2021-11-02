<?php

namespace LavandaBundle\Form;

use KMS\FroalaEditorBundle\Form\Type\FroalaEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array(
                "label"=>"Nombre del Producto",
                "attr"=>array("class"=>"form-control")
            ))
            ->add('descripcion', TextareaType::class, array(
                "label"=>"Descripción del Producto",
                "attr"=>array(
                    "class"=>"summernote"
                )
            ))
            ->add('precio', MoneyType::class, array(
                "label"=>"Precio del Producto",
                "currency"=>"MXN",
                "attr" => array("class" => "form-control", "onkeypress" => "return valideKey(event);"),
            ))
            /*->add('rutaimagen')
            ->add('nombreimagen')*/
            ->add('foto', FileType::class, array(
                "label"=>"Seleccione la foto del Producto",
                "attr"=>array("class"=>"form-control"),
                "mapped"=>false,
                "data_class"=>null
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
            'data_class' => 'LavandaBundle\Entity\Producto'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_producto';
    }


}
