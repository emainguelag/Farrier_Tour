<?php

namespace App\Form;

use App\Entity\Adress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstLine', TextType::class, [
                'label' => 'N° et voie:',
                'label_attr' => [
                    'class' => 'd-block'
                ],
                'attr' => [
                    'placeholder' => 'saisir le numéro et la voie',
                ]
            ])
            ->add('secondLine', TextType::class, [
                'label' => 'Complément d\'adresse:',
                'required'      => false,
                'label_attr' => [
                    'class' => 'd-block'
                ],
                'attr' => [
                    'placeholder' => 'saisir le complément d\'adresse',
                ]
            ])
            ->add('PostalCode', TextType::class, [
                'label' => 'Code postal:',
                'label_attr' => [
                    'class' => 'd-block'
                ],
                'attr' => [
                    'placeholder' => 'saisir le code postal',
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville:',
                'label_attr' => [
                    'class' => 'd-block'
                ],
                'attr' => [
                    'placeholder' => 'saisir la ville',
                ]
            ])
            ->add('country', TextType::class, [
                'label' => 'Pays:',
                'label_attr' => [
                    'class' => 'd-block'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adress::class,
        ]);
    }
}
