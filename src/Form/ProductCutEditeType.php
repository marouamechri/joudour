<?php

namespace App\Form;

use App\Entity\Cut;
use App\Entity\ProductCut;
use phpDocumentor\Reflection\PseudoTypes\True_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ProductCutEditeType extends AbstractType
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
                'required' => True,

            ])
            
            ->add('min', NumberType::class, [
                'label' => 'Stock Min',
                'mapped' => false,
                'required' => false
            ])
            ->add('max', NumberType::class, [
                'label' => 'Stock Max',
                'mapped' => false,
                'required' => false
            ])
            ->add('nbrProd', NumberType::class, [
                'label' => 'Quantite des Produits',
                'mapped' => false,
                'required' => false
            ])
        
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductCut::class,
        ]);
    }
}
