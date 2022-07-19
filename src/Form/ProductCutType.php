<?php

namespace App\Form;

use App\Entity\Cut;
use App\Entity\ProductCut;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ProductCutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cut', EntityType::class, [
                'label' => 'Choisissez une taille',
                'class' => Cut::class,
                'choice_label' => 'cutValue',
                'multiple' => false,
                'mapped' => true,
                'required' => false,

            ])
            ->add('min', NumberType::class, [
                'label' => 'Stock Min',
                'mapped' => false
            ])
            ->add('max', NumberType::class, [
                'label' => 'Stock Max',
                'mapped' => false
            ])
            ->add('nbrProd', NumberType::class, [
                'label' => 'Quantite des Produits',
                'mapped' => false
            ]);
            // ->add('startDatePricesSaleHTVA', DateTimeType::class, [
            //     'label'=>'Date début de validiter de prix',
            //     'mapped'=>false,
            //     'placeholder' => [
            //         'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
            //         'hour' => 'Heure', 'minute' => 'Minute', 'second' => 'Seconde',
            //     ],
            // ])
            // ->add('endDatePricesSaleHTVA', DateTimeType::class, [
            //     'label'=>'Date fin de validiter de prix',
            //     'mapped'=>false,
            //     'placeholder' => [
            //         'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
            //         'hour' => 'Heure', 'minute' => 'Minute', 'second' => 'Seconde',
            //     ],
            // ])

            // ->add('amountHTVA', MoneyType::class, [
            //     'label' => 'le prix de vente',
            //     'mapped'=>false
            // ])
            // ->add('active', CheckboxType::class, [
            //     'label'=>'Etat de prix',
            //     'mapped'=>false
            // ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductCut::class,
            
        ]);
    }
}
