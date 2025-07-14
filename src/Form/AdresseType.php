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
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullname',TextType::class,[
                'required'=> true,
                'label'=>'Nom , Prenom',
                'attr' => [
                    'placeholder' => 'Nom , Prenom'
                ],
            ])
            ->add('tel', TelType::class,[
                'label'=> 'Téléphone',
                'attr' => [
                    'placeholder'=>'Téléphone'
                ]
            ])
            ->add('adresse',TextareaType::class,[
                'required'=> true,
                'label'=>'Adresse',
                'attr' => [
                    'placeholder' => 'Adresse'
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
