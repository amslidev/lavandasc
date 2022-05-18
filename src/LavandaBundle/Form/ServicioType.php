<?php

namespace LavandaBundle\Form;

use KMS\FroalaEditorBundle\Form\Type\FroalaEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServicioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array(
                "label"=>"Nombre del Servicio",
                "attr"=>array("class"=>"form-control")
            ))
            ->add('tiempo', NumberType::class, array(
                "label"=>"Tiempo en minutos que dura el servicio",
                "attr"=>array("class"=>"form-control"),
                "attr" => array("class" => "form-control", "onkeypress" => "return valideKey(event);"),
            ))
            ->add('precio', MoneyType::class, array(
                "label"=>"Costo del servicio",
                "divisor"=>1,
                "currency"=>"MXN",
                "attr" => array("class" => "form-control", "onkeypress" => "return valideKey(event);"),
            ))
            /*->add('cobraronza', CheckboxType::class, array(
                "label"=>"¿El servicio se cobra por onza?",
                "attr"=>array("class"=>"form-control")
            ))*/
            ->add('descripcion', TextareaType::class, array(
                "label"=>"Descripción",
                "attr"=>array(
                    "class"=>"summernote",
                )
            ))
            ->add('file', FileType::class, array(
                "label" => "Fotografía del servicio",
                "attr" => array("class" => "form-control"),
                "mapped" => false,
                "data_class" => null,
            ))
            ->add('cobraronza', CheckboxType::class, array(
                "label" => "El servicio se cobra por el largo del cabello",
                "attr" => array("class" => "form-control"),
                "required" => false
            ))
            ->add('activo', CheckboxType::class, array(
                "label" => "¿El servicio está activo?",
                "attr" => array("class" => "form-control"),
                "required" => false
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
            'data_class' => 'LavandaBundle\Entity\Servicio'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_servicio';
    }


}
