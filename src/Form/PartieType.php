<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Entity\Partie;
use App\Entity\Tournois;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('duree')
            ->add('dateDerou')
            ->add('score1')
            ->add('score2')
            ->add('idEquipe1',EntityType::class, [
                        'class'=>Equipe::class,
                        'choice_label'=>'nom'

            ])
            ->add('idEquipe2',EntityType::class, [
                'class'=>Equipe::class,
                'choice_label'=>'nom'

            ])
            ->add('idTournoi',EntityType::class, [
                'class'=>Tournois::class,
                'choice_label'=>'nom'

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Partie::class,
        ]);
    }
}
