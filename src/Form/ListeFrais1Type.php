<?php

namespace App\Form;

use App\Entity\ListeFrais;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ListeFrais1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control']
            ])
            ->add('description', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('equipement', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('missions', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('repas', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('divers', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('TVA', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('debut_km', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('fin_km', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('montant_total', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('forfait_kilometrique', TextType::class, [
                'disabled' => true, 
                'required' => false, 
                'attr' => ['class' => 'form-control']
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ListeFrais::class,
        ]);
    }
}
