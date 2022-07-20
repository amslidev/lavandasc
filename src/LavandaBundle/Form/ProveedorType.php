<?php

namespace LavandaBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProveedorType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, [
                "label" => "Razón Social",
                "attr" => array("class" => "form-control")
            ])
            ->add('rfc', TextType::class, [
                "label" => "R.F.C.",
                "attr" => array("class"=>"form-control", "max" => "13")
            ])
            ->add('email', EmailType::class, [
                "label" => "Email",
                "attr" => array("class"=> "form-control")
            ])
            ->add('direccion', TextType::class, [
                "label" => "Dirección (Calle y/o avenida, colonia)",
                "attr" => array("class"=>"form-control"),
                "required" => false
            ])
            ->add('noint', TextType::class, [
                "label" => "No. Interior",
                "attr" => array("class"=>"form-control"),
                "required" => false
            ])
            ->add('noext', TextType::class, [
                "label" => "No. Exterior",
                "attr" => array("class"=>"form-control"),
                "required" => false
            ])
            ->add('idciudad', EntityType::class, [
                "label" => "Escriba el nombre de la ciudad",
                "placeholder" => "Seleccione un elemento",
                "class" => "LavandaBundle\Entity\Ciudad",
                "choice_label" => function($ciudad, $key, $index){
                    return $ciudad->getCiudadnombre().", ".$ciudad->getCiudaddistrito(). ", ".$ciudad->getPaiscodigo()->getPaisnombre();
                },
                "attr" => array("class" => "movies"),
                "required" => false,
                "query_builder" => function(EntityRepository $er){
                    return $er->createQueryBuilder('c')
                        ->orderBy('c.ciudadnombre', 'ASC');
                }
            ])
            ->add('contacto', TextType::class, [
                "label" => "Nombre de Contacto",
                "attr" => array("class" => "form-control"),
                "required" => false
            ])
            ->add('telefono', TextType::class, [
                "label" => "Teléfono de Contacto",
                "attr" => array("class" => "form-control"),
                "required" => false
            ])
            ->add('Guardar', SubmitType::class, [
                "attr" => array("class"=>"form-submit btn btn-success")
            ])
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LavandaBundle\Entity\Proveedor'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_proveedor';
    }


}
