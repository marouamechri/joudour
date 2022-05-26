<?php

namespace App\Form;

use App\Entity\Colors;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ColorType as TypeColor;


class ColorsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('refColor', TypeColor::class,[
                'label'=>'Choisissez une couleur: '
            ])
            ->add('nameColor', TextType::class,[
                'label' => 'nom de couleur'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Colors::class,
        ]);
    }
}
