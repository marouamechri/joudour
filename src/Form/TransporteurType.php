<?php

namespace App\Form;

use App\Entity\Transporteur;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class TransporteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameTransport', TextType::class,[
                'label'=>'Nom de transporteur'
            ])
            ->add('description', TextType::class,[
                'label'=>'Description'
            ])
            ->add('pricesTransport', MoneyType::class,[
                'label'=> 'Prix transport'
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transporteur::class,
        ]);
    }
}
