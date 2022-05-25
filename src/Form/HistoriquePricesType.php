<?php

namespace App\Form;

use App\Entity\HistoriquePrices;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HistoriquePricesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('start_date_prices_sale_htva')
            ->add('endDatePricesSaleHTVA')
            ->add('amountHTVA')
            ->add('ProductCut')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HistoriquePrices::class,
        ]);
    }
}
