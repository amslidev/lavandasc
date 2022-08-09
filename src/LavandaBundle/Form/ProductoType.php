<?php

namespace LavandaBundle\Form;

use Doctrine\ORM\EntityRepository;
use KMS\FroalaEditorBundle\Form\Type\FroalaEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
                "label"=>"Nombre ",
                "attr"=>array("class"=>"form-control")
            ))
            ->add('descripcion', TextareaType::class, array(
                "label"=>"Descripción ",
                "attr"=>array("class"=>"form-control")
            ))
            ->add('stockmin', NumberType::class, [
                "label" => "Stock mínimo ",
                "attr" => array("class"=>"form-control")
            ])
            ->add('unidadmedida', EntityType::class, [
                "label" => "Seleccione una Unidad de Medida",
                "placeholder" => "Seleccione un elemento",
                "class" => "LavandaBundle\Entity\Unidadesmedida",
                "attr" => array("class" => "form-control")
            ])
            ->add('idbodega', EntityType::class, [
                "label" => "Seleccione la bodega en la que se almacenará",
                "placeholder" => "Seleccione un elemento",
                "class" => "LavandaBundle\Entity\Bodegas",
                "attr" => array("class" => "form-control"),
                "query_builder" => function(EntityRepository  $er){
                    return $er->createQueryBuilder('b')
                        ->where('b.estado = 1');
                }
            ])
            ->add('idcategoria', EntityType::class, [
                "label" => "Seleccione la categoría a la que pertenece",
                "placeholder" => "Seleccione un elemento",
                "class" => "LavandaBundle\Entity\Categorias",
                "attr" => array("class"=>"form-control"),
            ])

            /*->add('rutaimagen')
            ->add('nombreimagen')*/
            ->add('foto', FileType::class, array(
                "label"=>"Seleccione la foto",
                "attr"=>array("class"=>"form-control"),
                "mapped"=>false,
                "data_class"=>null
            ))
            ->add('inventariocortesia', CheckboxType::class, [
                "label" => "¿Será utilizado como Producto para el Bar?",
                "attr" => array("class"=>"form-control")
            ])
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
