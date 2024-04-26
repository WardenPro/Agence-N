<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Conge;
use Symfony\Component\Form\AbstractType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CongeType extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->security->getUser();

        $builder
            ->add('mois', ChoiceType::class, [
                'choices'  => [
                    'Janvier' => 'janvier',
                    'Février' => 'février',
                    'Mars' => 'mars',
                    'Avril' => 'avril',
                    'Mai' => 'mai',
                    'Juin' => 'juin',
                    'Juillet' => 'juillet',
                    'Août' => 'août',
                    'Septembre' => 'septembre',
                    'Octobre' => 'octobre',
                    'Novembre' => 'novembre',
                    'Décembre' => 'decembre'
                    // Autres motifs
                ],
                'attr' => ['class' => 'form-control']
            ])
            ->add('motif', ChoiceType::class, [
                'choices'  => [
                    '-' => 'None',
                    'Absence Maladie' => 'Absence Maladie',
                    'Congé Payé' => 'Congé Payé',
                    'Absence Congés Spéciaux' => 'Absence Congés Spéciaux',
                    'Congés non Payés' => 'Congés non Payés',
                    // Autres motifs
                ],
                'attr' => ['class' => 'form-control']
            ])
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control']
            ])
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control']
            ])
            ->add('nbjour', IntegerType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('seen' , HiddenType::class, [
                'data' => 0
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Conge::class,
        ]);
    }
}
