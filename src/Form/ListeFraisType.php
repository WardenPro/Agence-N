<?php

namespace App\Form;

use App\Entity\ListeFrais;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListeFraisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', null, [
                'widget' => 'single_text',
            ])
            ->add('description')
            ->add('equipement')
            ->add('missions')
            ->add('repas')
            ->add('divers')
            ->add('TVA')
            ->add('debut_km')
            ->add('fin_km')
            ->add('montant_total')
            ->add('forfait_kilometrique')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ListeFrais::class,
        ]);
    }
}
