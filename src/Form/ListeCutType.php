<?php

namespace App\Form;

use App\Entity\ProductCut;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListeCutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //recuperer l'option productColor
        $productColor = $options['productColor'];
        $builder
        
            //afficher la liste de productCut de productColor   
            ->add('productCuts', EntityType::class, [
                'placeholder' => 'Choisissez une taille',
                'class' => ProductCut::class,
                'choice_label' => 'cut',
                'query_builder' =>function(EntityRepository $er)use($productColor){
                    return $er->createQueryBuilder('a')
                    ->andWhere('a.productColor = :productColor')
                    ->setParameter('productColor', $productColor)
                    ->andWhere('a.active = :active')
                    ->setParameter('active', true);
                },
                'multiple' => false,
                'mapped' => false,
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'productColor' => array(),
        ]);
    }
}
