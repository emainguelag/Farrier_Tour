<?php

namespace App\Form;

use App\Entity\Hoster;
use App\Entity\Adress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class HosterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom:',
                'label_attr' => [
                    'class' => 'd-block'
                ],
                'attr' => [
                    'placeholder' => 'saisir le nom',
                ]
            ])
            ->add('adressHoster', EntityType::class, [
                'class' => Adress::class,
                'label' => 'Adresse',
                'label_attr' => [
                    'class' => 'd-block'
                ],
                'choice_label' => 'firstLine',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Hoster::class,
        ]);
    }
}
