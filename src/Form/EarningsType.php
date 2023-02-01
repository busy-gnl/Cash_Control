<?php

namespace App\Form;

use App\Entity\Earnings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class EarningsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ex : Jean-Paul',
                    'maxlength' => 255,
                    'class' => 'crud-input',
                ],
                'label_attr' => [
                    'class' => 'crud-label',
                ],
                'required' => true,
                'label' => 'Prénom :',
            ])
            ->add('amount', IntegerType::class, [
                'attr' => [
                    'placeholder' => 10,
                    'min' => 1,
                    'max' => 60,
                    'class' => 'crud-input',
                ],
                'label_attr' => [
                    'class' => 'crud-label',
                ],
                'required' => true,
                'label' => 'Temps de lecture (en minutes) :',
            ])
            ->add('type', ChoiceType::class, [
                'required' => true,
                'label' => 'Temps de lecture (en minutes) :',
                'choices'  => [
                    'Maybe' => null,
                    'Yes' => true,
                    'No' => false,
                ],
                'attr' => [
                    'class' => 'crud-input',
                ],
                'label_attr' => [
                    'class' => 'crud-label',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Earnings::class,
        ]);
    }
}
