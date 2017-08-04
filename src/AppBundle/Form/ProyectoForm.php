<?php

namespace AppBundle\Form;

use AppBundle\Entity\Proyecto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ProyectoForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class)
            ->add('inicio', DateType::class, array('widget' => 'single_text',))
            ->add('termino', DateType::class, array('widget' => 'single_text',))
            //TODO: usar CollectionType (javascript en la vista para generar los campos)
            //Trabajadores
            ->add('trab1', TextType::class,
                array('label' => 'Trabajador 1',
                      'mapped' => false,
                      'required' => false))
            ->add('trab2', TextType::class,
                array('label' => 'Trabajador 2',
                    'mapped' => false,
                    'required' => false))
            ->add('trab3', TextType::class,
                array('label' => 'Trabajador 3',
                    'mapped' => false,
                    'required' => false))
            //Responsable legal
            ->add('resp_legal', TextType::class,
                array('label' => 'Responsable legal',
                    'mapped' => false,
                    'required' => false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Proyecto::class,
        ));
    }
}
