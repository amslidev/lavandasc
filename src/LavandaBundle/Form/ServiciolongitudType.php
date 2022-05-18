<?php

namespace LavandaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiciolongitudType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('longitud', ChoiceType::class, array(
                "label" => "Seleccione la longitud",
                "placeholder" => "Seleccione un elemento",
                "choices" => [
                    "45 cm" => "45",
                    "50 cm" => "50",
                    "55 cm" => "55",
                    "60 cm" => "60",
                    "65 cm" => "65",
                    "70 cm" => "70",
                    "75 cm" => "75",
                ],
                "attr" => array("class"=>"form-control")
            ))
            ->add('precio', MoneyType::class, array(
                "label" => "Precio",
                "attr" => array("class" => "form-control"),
                "currency" => "MXN"
            ))
            ->add('Guardar', SubmitType::class, array(
                "attr" => array("class" => "form-submit btn btn-success")
            ))
            //->add('idservicio')
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LavandaBundle\Entity\Serviciolongitud'
        ));
    }

    public function getName(){
        return 'serviciolongitud';
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_serviciolongitud';
    }


}
