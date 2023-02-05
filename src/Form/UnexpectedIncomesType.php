<?php

namespace App\Form;

use App\Entity\UnexpectedIncomes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class UnexpectedIncomesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ex : héritage',
                    'maxlength' => 255,
                    'class' => 'crud-input form-control',
                ],
                'label_attr' => [
                    'class' => 'crud-label form-label',
                ],
                'required' => true,
                'label' => 'Entrée d\argent inattendue:',
                'help' => "Le nom est à titre indicatif afin que </br>
                vous puissiez identifier facilement ce à quoi il correspond.",
                'help_html' => true,
            ])
            ->add('amount', IntegerType::class, [
                'attr' => [
                    'placeholder' => 60,
                    'min' => 1,
                    'max' => 1000000,
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
            'data_class' => UnexpectedIncomes::class,
        ]);
    }
}
