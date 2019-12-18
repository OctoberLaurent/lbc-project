<?php

namespace App\Form;

use App\Entity\Addresses;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AddresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // adress 
            ->add('adress' , TextType::class, [ 
                'label' => 'Adresse : '
                ])
            // additional information
            ->add('additional' , TextType::class, [ 
                'label' => 'Additional information : '
                ])
            // zipcode
            ->add('postalcode' , TextType::class, [ 
                'label' => 'Postal Code : '
                ])
            ->add('city')
            ->add('region')
            ->add('country')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Addresses::class,
        ]);
    }
}
