<?php

namespace LavandaBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, array(
                "label" => "Nombre",
                "attr" => array("class"=>"form-control"),
            ))
            ->add('apellido', TextType::class, array(
                "label" => "Apellidos",
                "attr" => array("class"=>"form-control"),
            ))
            ->add('telefono', TextType::class, array(
                "label" => "No. Teléfono",
                "attr" => array("class"=>"form-control"),
            ))
            ->add('email', TextType::class, array(
                "label" => "Email",
                "attr" => array("class"=>"form-control"),
            ))
            ->add('idsucursal', EntityType::class, array(
                "label" => "Sucursal en la que le gustaría visitarnos",
                "class" => "LavandaBundle\Entity\Sucursal",
                "placeholder" => "Seleccione un elemento",
                "query_builder" => function(EntityRepository  $er){
                    return $er->createQueryBuilder('s')
                        ->where('s.activo = 1');
                },
                "attr" => array("class"=>"form-control")
            ))
            ->add('comentarios', TextareaType::class, array(
                "label" => "Platíquenos en qué podemos ayudarle",
                "attr" => array("class"=>"form-control"),
            ))
            ->add('enviar', SubmitType::class, array(
                "label"=>"Enviar",
                "attr"=> array("class"=>"form-submit btn btn-success")
            ))
            //->add('createdAt')
            //->add('isactive')
            //->add('rutaimagen')
            //->add('nombreimagen')
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LavandaBundle\Entity\Contacto',
            'csrf_protection' =>  true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'contacto_item'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'lavandabundle_contacto';
    }


}
