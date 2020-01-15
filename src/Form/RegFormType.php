<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('roles')
            ->add('password')
            ->add('Email')
            ->add('Image')
            ->add('SecurityQuestion')
            ->add('SecurityAnswer')
            ->add('Phone')
            ->add('Birthday')
            ->add('WatchListSize')
            ->add('Description')
            ->add('MoviesSeenCount')
            ->add('ComentCount')
            ->add('RatingCount')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
