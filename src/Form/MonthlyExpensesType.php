<?php

namespace App\Form;

use App\Entity\MonthlyExpenses;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class MonthlyExpensesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ex : abonnement netflix',
                    'maxlength' => 255,
                    'class' => 'crud-input form-control',
                ],
                'label_attr' => [
                    'class' => 'crud-label form-label',
                ],
                'required' => true,
                'label' => 'Frais mensuel récurrent :',
            ])
            ->add('amount', IntegerType::class, [
                'attr' => [
                    'placeholder' => 10,
                    'min' => 1,
                    'max' => 10000,
                    'class' => 'crud-input form-control',
                ],
                'label_attr' => [
                    'class' => 'crud-label form-label',
                ],
                'required' => true,
                'label' => 'Montant :',
            ])
            ->add('type', ChoiceType::class, [
                'required' => true,
                'label' => 'Type de frais :',
                'choices'  => [
                    'Loyer' => 'rent',
                    'Crédit' => 'loan',
                    'Alimentation (courses)' => 'grocery_shopping',
                    'Assurance' => 'insurance',
                    'Abonnement' => 'subscription',
                    'Frais de transport' => 'transport',
                    'Frais de scolarité (enfants)' => 'education',
                    'Frais bancaire' => 'bank',
                    'Autre' => 'other',
                ],
                'attr' => [
                    'class' => 'crud-input form-control',
                ],
                'label_attr' => [
                    'class' => 'crud-label form-label',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MonthlyExpenses::class,
        ]);
    }
}
