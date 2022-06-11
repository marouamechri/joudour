<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('street',TextareaType::class,[
                'required'=> true,
                'label'=>'Adresse',
                'attr' => [
                    'placeholder' => 'Adresse'
                ],
            ])
            ->add('number', IntegerType::class,[
                'required'=> true,
                'label'=>'Numéro',
                'attr' => [
                    'placeholder' => 'Numéro'
                ],
            ])
            ->add('apartement', IntegerType::class,[
                'label'=>'Appartement',
                'attr' => [
                    'placeholder' => 'Appartement'
                ],
            ])
            ->add('message', TextareaType::class,[
                'label'=>'Message',
                'required'=>false,
                'attr' => [
                    'placeholder' => 'Message'
                ],
            ])
            ->add('country_code', IntegerType::class,[
                'required'=> true,
                'label'=>'Code postal',
                'attr' => [
                    'placeholder' => 'Code postal'
                ],
            ])
            ->add('city', TextType::class,[
                'required'=> true,
                'label'=>'Ville',
                'attr' => [
                    'placeholder' => 'Ville'
                ],
            ])
            
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
