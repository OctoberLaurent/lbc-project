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

class AdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('price', NumberType::class)
            ->add('description', TextType::class)
            ->add('state', ChoiceType::class, [
                'choices' => [
                    'new' => 'new',
                    'used'=>'used',
                    'broken'=>'broken'
                    ]
            ])
            ->add('category', EntityType::class, [
                'class' => Categories::class,
                'choice_label' => function ($category) {
                    return $category->getName();
                }
            ])
            ->add('location', AddresseType::class)
            //->add('users')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ads::class,
        ]);
    }
}
