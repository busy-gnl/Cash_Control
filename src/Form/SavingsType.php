<?php

namespace App\Form;

use App\Entity\Savings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SavingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', ChoiceType::class, [
                'required' => true,
                'label' => 'Type de placement :',
                'choices'  => [
                    'Loyer' => 'Loyer',
                    'Crédit' => 'Crédit',
                    'Alimentation (courses)' => 'Alimentation (courses)',
                    'Assurance' => 'Assurance',
                    'Abonnement' => 'Abonnement',
                    'Frais de transport' => 'Frais de transport',
                    'Frais de scolarité (enfants)' => 'Frais de scolarité (enfants)',
                    'Frais bancaire' => 'Frais bancaire',
                    'Autre' => 'Autre',
                ],
                'attr' => [
                    'class' => 'crud-input form-control',
                ],
                'label_attr' => [
                    'class' => 'crud-label form-label',
                ],
            ])
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ex : assurance vie',
                    'maxlength' => 255,
                    'class' => 'crud-input form-control',
                ],
                'label_attr' => [
                    'class' => 'crud-label form-label',
                ],
                'required' => true,
                'label' => 'Libellé du placement :',
                'help' => "Le libellé est à titre indicatif afin que </br>
            vous puissiez identifier facilement ce à quoi il correspond.",
                'help_html' => true,
            ])
            ->add('amount', IntegerType::class, [
                'attr' => [
                    'placeholder' => 100,
                    'min' => 1,
                    'max' => 1000,
                    'class' => 'crud-input form-control',
                ],
                'label_attr' => [
                    'class' => 'crud-label form-label',
                ],
                'required' => true,
                'label' => 'Montant :',
            ])
            ->add('profitability', NumberType::class, [
                'attr' => [
                    'placeholder' => 5,
                    'min' => 1,
                    'max' => 100,
                    'class' => 'crud-input form-control',
                ],
                'label_attr' => [
                    'class' => 'crud-label form-label',
                ],
                'required' => true,
                'label' => 'Pourcentage de rendement annuel (en %) :',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Savings::class,
        ]);
    }
}
