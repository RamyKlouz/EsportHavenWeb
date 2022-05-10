<?php

namespace App\Form;

use App\Entity\Sponsors;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SponsorsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('societe')
            ->add('nomSponsor')
            ->add('montant')
            ->add('typeSponsor', ChoiceType::class, [
                'choices'  => [
                    'CDI ' => 'CDI ',
                    'CDD ' => 'CDD ',
                ],
            ])

            ->add('image', FileType::class, array('data_class' => null,'required' => false),  [
                'label' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sponsors::class,
        ]);
    }
}
