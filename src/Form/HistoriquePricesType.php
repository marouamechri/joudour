<?php

namespace App\Form;

use App\Entity\HistoriquePrices;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class HistoriquePricesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('startDatePricesSaleHTVA', DateTimeType::class, [
            'label'=>'Date début de validiter de prix',
            'placeholder' => [
                'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                'hour' => 'Heure', 'minute' => 'Minute', 'second' => 'Seconde',
            ],
        ])
        ->add('endDatePricesSaleHTVA', DateTimeType::class, [
            'label'=>'Date fin de validiter de prix',
            'placeholder' => [
                'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                'hour' => 'Heure', 'minute' => 'Minute', 'second' => 'Seconde',
            ],
        ])

        ->add('amountHTVA', MoneyType::class, [
            'label' => 'le prix de vente',
        ])
        ->add('active', CheckboxType::class, [
            'label'=>'Etat de prix',
           
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HistoriquePrices::class,
        ]);
    }
}
