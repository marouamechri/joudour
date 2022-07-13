<?php

namespace App\Form;

use App\Entity\Option;
use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameProduct', TextType::class, [
                'label'=>'Nom de produit: ',
                'required'=>false
            ])
            ->add('descriptionProduct', CKEditorType::class,[
                'label'=>'description de l\'article: ',
                'required'=>false
            ])
            ->add('genre',  ChoiceType::class,[
                'choices' => [
                    'Femme' => 'Femme',
                    'Homme' => 'Homme',
                    'Enfant'=>'Enfant'                 
                ],
                'expanded' => true,
                'multiple' => false,
                'label'=> 'Genre:'
            ])
            ->add('amountHTVA', MoneyType::class ,[
                'label'=>'montant HTVA: ',
                'required'=>false
            ])
            ->add('action',  ChoiceType::class,[
                'choices' => [
                    'Vente' => 'Vente',
                    'Location' => 'Location',
                ],
                'expanded' => true,
                'multiple' => false,
                'label'=> 'Action de produit: '
            ])
            ->add('picture', FileType::class,[
                'label'=>'Ajouter une Image de produit: ',
                'mapped'=>false,
                'required'=>false
            ])
            ->add('active', CheckboxType::class, [
                'label'=>'Active',
                'required'=>false
            ])
            ->add('newColletion', CheckboxType::class, [
                'label'=>'Nouvelle collection?',
                'required'=>false
            ])
            ->add('typeProduct', EntityType::class, [
                'class'=> Option::class,
                'choice_label'=>'nameOption',
                'multiple'=>false,
                'mapped'=>true,
                'required'=>false,
                'label'=>'Type produit'
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
