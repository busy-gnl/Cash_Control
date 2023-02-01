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
                    'placeholder' => 'Ex : salaire',
                    'maxlength' => 255,
                    'class' => 'crud-input form-control',
                ],
                'label_attr' => [
                    'class' => 'crud-label form-label',
                ],
                'required' => true,
                'label' => 'Libellé du revenu :',
                'help' => "Le libellé est juste à titre indicatif afin que </br>
                vous puissiez rapidement identifier facilement à quoi il correspond.",
                'help_html' => true
            ])
            ->add('amount', IntegerType::class, [
                'attr' => [
                    'placeholder' => 1353,
                    'min' => 1,
                    'max' => 100000,
                    'class' => 'crud-input form-co du revenuntrol',
                ],
                'label_attr' => [
                    'class' => 'crud-label form-label',
                ],
                'required' => true,
                'label' => 'Montant :',
            ])
            ->add('type', ChoiceType::class, [
                'required' => true,
                'label' => 'Type du revenu :',
                'choices'  => [
                    'Salaire' => 'salary',
                    'Prestation sociale (retraite, chômage, invalidité)' => 'allowance',
                    'Rente immobilière' => "property_rent",
                    'Investissement divers' => "investment",
                    'Pension alimentaire' => "child_support",
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
            'data_class' => Earnings::class,
        ]);
    }
}
