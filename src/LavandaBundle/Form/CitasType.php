<?php

namespace LavandaBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CitasType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('fechacita')
            //->add('horarioinicio')
            //->add('horariofin')
            //->add('comentarios')
            //->add('idcliente')
            //->add('idcortesia')
            ->add('idsucursal', EntityType::class, array(
                "label" => "Seleccione la sucursal",
                "placeholder" => "Seleccione un elemento",
                "class" => "LavandaBundle\Entity\Sucursal",
                "query_builder" => function(EntityRepository $er){
                    return $er->createQueryBuilder('s')
                        ->where('s.activo = 1');
                },
                "attr" => array("class" => "form-control")
            ))
            /*->add('idempleado', EntityType::class, array(
                "label"=>"Seleccione al colaborador",
                "placeholder"=>"Seleccione un elemento",
                "class"=>"LavandaBundle\Entity\Empleado",
                "query_builder"=> function(EntityRepository $er){
                    return $er->createQueryBuilder('e')
                        ->where('e.activo = 1')
                        ->orderBy('e.nombre', 'ASC');
                },
                "choice_label"=>function($empleado, $key, $index){
                    return $empleado->getNombre()." ".$empleado->getApellido();
                },
                "attr"=>array("class"=>"form-control")
            ))*/
            //->add('idestatus')
            //->add('idservicio')
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LavandaBundle\Entity\Citas'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_citas';
    }


}
