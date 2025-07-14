<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class,[
                'label'=>'Nom et Prenom',
                'mapped'=>false,
                'attr' => [
                    'placeholder' => 'Votre nom et prénom'
                ],
            ])
            ->add('Email',EmailType::class,[
                'label'=>'E-mail',
                'mapped'=>false,
                'attr' => [
                    'placeholder' => 'E-mail'
                ],
                'constraints'=>[
                    new NotBlank(['message'=> 'Veuillez fournir un email valide']),
                    new Email(['message'=>'Votre email ne semble pas valide'])
                ]
            ])
            ->add('message',TextareaType::class,[
                'label'=>'Message',
                'mapped'=>false,
                'attr' => [
                    'placeholder' => 'Saisissez votre message ici ...'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
