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
            ->add('type', ChoiceType::class, [
                'required' => true,
                'label' => 'Type du revenu :',
                'choices'  => [
                    'Salaire' => 'Salaire',
                    'Prestation sociale (retraite, chômage, invalidité)' => 'Prestation sociale',
                    'Aide sociale (CAF, prime d\'activité, etc..)' => 'Aide sociale',
                    'Rente immobilière' => "Rente immobilière",
                    'Investissement' => "Investissement",
                    'Pension alimentaire' => "Pension alimentaire",
                    'Autre' => 'Autre',
                ],
                'attr' => [
                    'class' => 'crud-input form-control',
                ],
                'label_attr' => [
                    'class' => 'crud-label form-label',
                ],
            ])
            ->add('amount', IntegerType::class, [
                'attr' => [
                    'placeholder' => 1353,
                    'min' => 1,
                    'max' => 100000,
                    'class' => 'crud-input form-control',
                ],
                'label_attr' => [
                    'class' => 'crud-label form-label',
                ],
                'required' => true,
                'label' => 'Montant :',
            ])
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
                'help' => "Le libellé est à titre indicatif afin que </br>
                vous puissiez identifier facilement ce à quoi il correspond.",
                'help_html' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Earnings::class,
        ]);
    }
}
