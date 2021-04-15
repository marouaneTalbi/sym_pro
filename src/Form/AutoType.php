<?php

namespace App\Form;

use App\Entity\Auto;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AutoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marque',)
            ->add('modele')
            ->add('pays', TextType::class,['attr' =>['placeholder' =>'veuillez entrez le Pays']])
            ->add('prix', NumberType::class,['attr' =>['placeholder' =>'veuillez entrez le Prix']])
            ->add('category', EntityType::class,['label' =>'categorie','class'=>Categorie::class,'choice_label'=>'nom'])
            ->add('description', TextareaType::class,['attr' =>['placeholder' =>'Description']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Auto::class,
        ]);
    }
}
