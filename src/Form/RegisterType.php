<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder
            /* Adresse email */
            ->add('email', EmailType::class, [
            'label' => "Adresse Email",
            'required' => true,
            'attr' => ['class' => 'form-control' ],
            'constraints' => [
                    new NotBlank([
                        'message' => "Saisir une adresse email.",
                    ]),
                    new Email([
                        'message' => "L'adresse email n'est pas valide.",
                    ]),
                ],
            ])

            /* Mot de passe */
            ->add('password', RepeatedType::class, [
                'label' => false,
                'type' => PasswordType::class,
                'first_options'  => [
                    'label' => "Nouveau mot de passe",
                    'attr' => ['class' => 'form-control' ],
                    'required' => true,
                    'constraints' => [
                        new NotNull([
                            'message' => "Saisir votre nouveau mot de passe",
                        ]),
                        new NotBlank([
                            'message' => "Saisir votre nouveau mot de passe",
                        ]),
                    ],
                ],
                'second_options' => [
                    'label' => "Repéter le mot de passe",
                    'attr' => ['class' => 'form-control' ],
                    'constraints' => [
                        new NotBlank([
                            'message' => "Repéter le mot de passe",
                        ]),
                    ],
                ],
                'invalid_message' => "Les mots de passe doivent etre identiques.",
            ])           

            ->add('firstname', TextType::class, [
                'label' => "Prénom",
                'attr' => ['class' => 'form-control' ],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir votre Prénom."
                    ])
                ],
            ])
        
            /* Nom */
            ->add('lastname', TextType::class, [
                'label' => "Nom",
                'attr' => ['class' => 'form-control' ],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => "Saisir votre Nom."
                    ])
                ],
            ])

        ->add('phone', TextType::class, [
            'attr' => ['class' => 'form-control']])

        ->add('birthday', DateType::class, [
            'attr' => ['class' => 'form-control']]);
}

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
