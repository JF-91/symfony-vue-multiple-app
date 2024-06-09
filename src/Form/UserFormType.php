<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter an email',
                    ]),
                    new Length([
                        'max' => 180,
                        'maxMessage' => 'Your email should be less than {{ limit }} characters',
                    ]),
                ],
            ])
            ->add('password', null, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('firstName', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a first name',
                    ]),
                    new Length([
                        'max' => 180,
                        'maxMessage' => 'Your first name should be less than {{ limit }} characters',
                    ]),
                ],
            ])
            ->add('lastName', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a last name',
                    ]),
                    new Length([
                        'max' => 180,
                        'maxMessage' => 'Your last name should be less than {{ limit }} characters',
                    ]),
                ],
            ])
            ->add('agreeTerms', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please agree to our terms',
                    ]),
                    new IsTrue([
                        'message' => 'You should agree to our terms',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
