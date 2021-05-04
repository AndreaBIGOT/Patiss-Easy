<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\RecetteIngredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecetteIngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantite')
            ->add('idrecette')
            // ->add('iding')
            // ->add('iding', EntityType::class, [
            //     'label' => "Ingrédient",
            //     'class' => Ingredient::class,
            //     'multiple' => true,
            //     'choice_label' => "ingredient",
            //     'attr' => ['class' => "selectpicker","multiple" => "", 'data-live-search' => "true", 'title' => "Ingrédients"],
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RecetteIngredient::class,
        ]);
    }
}
