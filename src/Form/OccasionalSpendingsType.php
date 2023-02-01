<?php

namespace App\Form;

use App\Entity\OccasionalSpendings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class OccasionalSpendingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ex : resto en amoureux',
                    'maxlength' => 255,
                    'class' => 'crud-input form-control',
                ],
                'label_attr' => [
                    'class' => 'crud-label form-label',
                ],
                'required' => true,
                'label' => 'Dépense occasionnelle :',
            ])
            ->add('amount', IntegerType::class, [
                'attr' => [
                    'placeholder' => 60,
                    'min' => 1,
                    'max' => 1000,
                    'class' => 'crud-input form-control',
                ],
                'label_attr' => [
                    'class' => 'crud-label form-label',
                ],
                'required' => true,
                'label' => 'Montant :',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OccasionalSpendings::class,
        ]);
    }
}
