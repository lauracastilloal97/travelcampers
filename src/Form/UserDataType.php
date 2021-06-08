<?php

namespace App\Form;

use App\Entity\UserData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class UserDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('fistname')
            ->add('lastname')
            ->add('dni')
            ->add('birthdate', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('genre', ChoiceType::class, [
                'choices' => [
                    'Hombre' => 'Hombre',
                    'Mujer' => 'Mujer',
                    'Prefiero no decirlo' => 'Prefiero no decirlo',
                    'Otros' => 'Otros',
                    
                ],
            ])
            ->add('city')
            ->add('cp')
            ->add('phoneNumber')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserData::class,
        ]);
    }
}
