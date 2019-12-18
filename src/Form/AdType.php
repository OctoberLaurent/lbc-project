<?php

namespace App\Form;

use App\Entity\Ads;
use App\Entity\Categories;
use App\Form\AddresseType;
use Doctrine\DBAL\Types\DecimalType;
use Symfony\Component\Form\AbstractType;
use Doctrine\Common\Annotations\Annotation\Enum;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // Ad title
            ->add('title', TextType::class, [ 
                'label' => 'Title of ad : '
                ])
            // price
            ->add('price', NumberType::class, [ 
                'label' => 'Price : '
                ])
            // Description
            ->add('description', TextareaType::class, [ 
                'label' => 'Description : '
                ])
            // object states
            ->add('state', ChoiceType::class, [
                'label' => 'Choise state : ',
                'choices' => [
                    'new' => 'new',
                    'used'=>'used',
                    'broken'=>'broken'
                ]
            ])
            // object category
            ->add('category', EntityType::class, [
                'class' => Categories::class,
                'choice_label' => function ($category) {
                    return $category->getName();
                }
            ])
            // object location
            ->add('location', AddresseType::class, [ 
                'label' => 'Where is it ? : '
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ads::class,
        ]);
    }
}
