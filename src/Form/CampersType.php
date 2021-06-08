<?php

namespace App\Form;

use App\Entity\Campers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\Response;


class CampersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('descripcion')
            ->add('matricula')
            ->add('marca')
            ->add('modelo')
            ->add('precio')
            ->add('capacidad')
            ->add('dimensiones')
            ->add('wc')
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
            'data_class' => Campers::class,
        ]);
    }
}
