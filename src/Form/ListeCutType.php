<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\ProductCut;
use App\Entity\ProductColor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListeCutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        // ->add('productColors', EntityType::class,[
        //     'placeholder' => 'Choisissez une color',
        //         'class' => ProductColor::class,
        //         'choice_label' => 'color.nameColor',
        //         'multiple' => false,
        //         'mapped' => false,
        //         'required' => false
        //     ])
            
            ->add('productCuts', EntityType::class, [
                'placeholder' => 'Choisissez une taille',
                'class' => ProductCut::class,
                'choice_label' => 'cut',
                'multiple' => false,
                'mapped' => false,
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductCut::class,
        ]);
    }
}
