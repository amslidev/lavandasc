<?php

namespace LavandaBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExpedienteclienteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('idcliente')
            ->add('idtipocuero', EntityType::class, array(
                "label" => "Tipo de Cuero Cabelludo",
                "class" => "LavandaBundle\Entity\Tipocuero",
                "placeholder" => "Seleccione un elemento",
                "attr" => array("class" => "form-control")
            ))
            ->add('iddiagnostico', EntityType::class, array(
                "label" => "Análisis o Diagnóstico",
                "class" => "LavandaBundle\Entity\Diagnostico",
                "placeholder" => "Seleccione un elemento",
                "attr" => array("class" => "form-control")
            ))
            ->add('decoloracion', CheckboxType::class, array(
                "label" => "Decoloración",
                "attr" => array("class" => "form-control"),
                "required" => false
            ))
            ->add('cantidaddecoloracion', NumberType::class, array(
                "label" => "¿Cuántos procesos de decoloración ha tenido?",
                "attr" => array("class" => "form-control", "onkeypress" => "return valideKey(event);"),
                "required" => false
            ))
            ->add('planchadopermanente', CheckboxType::class, array(
                "label" => "Planchados permanentes",
                "attr" => array("class" => "form-control"),
                "required" => false
            ))
            ->add('cantidadplanchado', NumberType::class, array(
                "label" => "¿Cuántos procesos de planchado permanente ha tenido?",
                "attr" => array("class" => "form-control", "onkeypress" => "return valideKey(event);"),
                "required" => false
            ))
            ->add('tintes', CheckboxType::class, array(
                "label" => "Tintes",
                "attr" => array("class" => "form-control"),
                "required" => false
            ))
            ->add('cantidadtintes', NumberType::class, array(
                "label" => "¿Cuántos tintes se ha aplicado?",
                "attr" => array("class" => "form-control", "onkeypress" => "return valideKey(event);"),
                "required" => false
            ))
            ->add('alisadosprogresivos', CheckboxType::class, array(
                "label" => "Alasiados progresivos",
                "attr" => array("class" => "form-control"),
                "required" => false
            ))
            ->add('cantidadalisados', NumberType::class, array(
                "label" => "¿Cuántos alasiados progresivos se ha aplicado?",
                "attr" => array("class" => "form-control", "onkeypress" => "return valideKey(event);"),
                "required" => false
            ))
            ->add('caspa', CheckboxType::class, array(
                "label" => "¿Presenta psoriasis o caspa?",
                "attr" => array("class" => "form-control"),
                "required" => false
            ))
            ->add('alergiacosmetico', CheckboxType::class, array(
                "label" => "¿Alguna vez ha tenido alergia a algún tipo de cosmético?",
                "attr" => array("class"=>"form-control"),
                "required" => false
            ))
            ->add('nombrecosmetico', TextType::class, array(
                "label" => "En caso de que la respuesta sea afirmativa, ingrese el nombre del cosmético al que presenta alergia",
                "attr" => array("class" => "form-control"),
                "required" => false
            ))
            ->add('alergiaquimico', CheckboxType::class, array(
                "label" => "¿Tiene alergia a algún componente químico?",
                "attr" => array("class"=>"form-control"),
                "required" => false
            ))
            ->add('nombrequimico', TextType::class, array(
                "label" => "En caso de que la respuesta sea afirmativa, ingrese el nombre del químico al que presenta alergia",
                "attr" => array("class" => "form-control"),
                "required" => false
            ))
            ->add('productosacidos', CheckboxType::class, array(
                "label" => "¿Usas productos ácidos o para pelar la piel?",
                "attr" => array("class"=>"form-control"),
                "required" => false
            ))
            ->add('nombreproductoacido', TextType::class, array(
                "label" => "En caso de que la respuesta sea afirmativa, ingrese el nombre del producto que utiliza",
                "attr" => array("class" => "form-control"),
                "required" => false
            ))
            ->add('usomedicamentos', CheckboxType::class, array(
                "label" => "¿Uso diario de medicamentos?",
                "attr" => array("class"=>"form-control"),
                "required" => false
            ))
            ->add('nombremedicamentos', TextType::class, array(
                "label" => "En caso de que la respuesta sea afirmativa, ingrese el nombre del medicamento que utiliza",
                "attr" => array("class" => "form-control"),
                "required" => false
            ))
            ->add('embarazada', CheckboxType::class, array(
                "label" => "¿Está embarazada o amamantando?",
                "attr" => array("class"=>"form-control"),
                "required" => false
            ))
            ->add('Guardar', SubmitType::class, array(
                "attr" => array("class" => "form-submit btn btn-success")
            ))
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LavandaBundle\Entity\Expedientecliente'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_expedientecliente';
    }


}
