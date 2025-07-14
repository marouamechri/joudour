<?php

namespace App\Form;

use App\Entity\ImagewebSite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ImagewebSiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
          
            
            ->add('titrePoster',TextType::class,[
                'label'=>'text de le photo d\'affiche'
            ])
            ->add('posterTextBtn',TextType::class,[
                'label'=>'text bouton d\'affiche'
                ])
            ->add('poster', FileType::class,[
                'label'=>'Image d\'affiche ',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('robe1', FileType::class,[
                'label'=>'Robe mariée image 1:',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('robe2', FileType::class,[
                'label'=>'Robe mariée image 2:',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('robe3', FileType::class,[
                'label'=>'Robe mariée image 3:',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('imgShop1', FileType::class,[
                'label'=>'Vente image 1',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('imgShop2', FileType::class,[
                'label'=>'Vente image 2:',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('imgShop3', FileType::class,[
                'label'=>'vente image 3: ',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('imgloca1', FileType::class,[
                'label'=>'Location image 3: ',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('imgloca2', FileType::class,[
                'label'=>'Location image 3: ',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('imgloca3', FileType::class,[
                'label'=>'Location image 3: ',
                'mapped'=>false,
                'required'=>false
            ]) 
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ImagewebSite::class,
        ]);
    }
}
