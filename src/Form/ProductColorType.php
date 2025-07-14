<?php

namespace App\Form;

use App\Entity\Colors;
use App\Entity\ProductColor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductColorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('color', EntityType::class, [
                'class'=> Colors::class,
                'choice_label'=>'nameColor',
                'multiple'=>false,
                'mapped'=>true,
                'required'=>false,
                'label'=>'Coleur '
            ])
            //ajouter le champ image dans la formulaire
            ->add('images', FileType::class, [
                'label'=>'Ajouter les images',
                'multiple'=> true,
                'mapped'=>false,
                'required'=>false
            ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductColor::class,
        ]);
    }
}
