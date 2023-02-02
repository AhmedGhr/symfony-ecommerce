<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'email',
                EmailType::class,
                [
                    'disabled' => true,
                    'label' => 'Your Email'
                ]
            )
            ->add('Firstname', TextType::class, [
                'disabled' => false,
                'label' => 'Your first name'
            ])
            ->add('Lastname', TextType::class, [
                'disabled' => false,
                'label' => 'Your last name'
            ])
            ->add('old_password', PasswordType::class, [
                'label' => 'Your actual password',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Write down your actual password please'
                ]

            ])
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'Passwords dont match',
                'label' => 'Your new password ',
                'required' => true,
                'first_options' => [
                    'label' => 'Your new password',
                    'attr' => [
                        'placeholder' => 'Write down your new password please'

                    ]
                ],
                'second_options' => [
                    'label' => 'Confirm your Password',
                    'attr' => [
                        'placeholder' => 'Confirm your password'

                    ]
                ],

            ])
            ->add('submit', SubmitType::class, [
                'label' => "Update",
                'attr' => ['class' => 'btn-warning']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
