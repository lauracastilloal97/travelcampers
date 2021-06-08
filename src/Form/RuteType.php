<?php

namespace App\Form;

use App\Entity\Rute;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\Response;


class RuteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('visitar')
            ->add('dias')
            ->add('km')
            ->add('tiempo')
            ->add('parada')
            ->add('restaurante')
            ->add('camping')
            ->add('image', FileType::class, [
                'label' => 'image (jpeg file)',
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/x-jpeg',
                            'image/png',
                            'image/x-png',
                        ],
                        'mimeTypesMessage' => 'Por favor sube un archivo valido',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rute::class,
        ]);
    }
}
