<?php

namespace App\Form;

use App\Entity\Farrier;
use App\Entity\Adress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FarrierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('role')
            ->add('adressFarrier', EntityType::class, [
                'class' => Adress::class,
                'label' => 'Adresse',
                'choice_label' => 'firstLine',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Farrier::class,
        ]);
    }
}
