<?php

namespace App\Form;

use App\Entity\Tournois;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TournoisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('nbEquipes')
            ->add('dateDeb')
            ->add('dateFin')
            ->add('jeux')
            ->add('Confirmer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tournois::class,
            'novalidate'=>'novalidate',
            ]);

    }
}
