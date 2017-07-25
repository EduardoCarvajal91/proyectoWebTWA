<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 14-07-2017
 * Time: 11:47
 */

// src/AppBundle/Form/PersonaType.php
namespace AppBundle\Form;

use AppBundle\Entity\Persona;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RegisterForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rol', EntityType::class, array(
                'class' => 'AppBundle\Entity\Rol',
                'choice_label' => 'nombre',
            ))
            ->add('rut', TextType::class)
            ->add('email', EmailType::class)
            ->add('nombre', TextType::class)
            ->add('paterno', TextType::class, array('label' => 'Apellido paterno'))
            ->add('materno', TextType::class, array('label' => 'Apellido materno'))
            ->add('fechaNacimiento', DateType::class, array('widget' => 'single_text',))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Contraseña'),
                'second_options' => array('label' => 'Repita contraseña'),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Persona::class,
        ));
    }
}