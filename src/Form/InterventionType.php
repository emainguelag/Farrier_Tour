<?php

namespace App\Form;

use App\Entity\Intervention;
use App\Entity\Horse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class InterventionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startDate', DateTimeType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'attr' => ['class' => 'form-control'],
                'label' => 'Début:',
                'label_attr' => [
                    'class' => 'd-block'
                ],
            ])
            ->add('endDate', DateTimeType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'attr' => ['class' => 'form-control mt-2 mb-2'],
                'label' => 'Fin:',
                'label_attr' => [
                    'class' => 'd-block'
                ],
            ])
            ->add('service', ChoiceType::class, [
                'choices' => [
                    'Parage' => 'Parage',
                    'Ferrage' => 'Ferrage',
                ],
                'label' => 'Prestation:',
                'label_attr' => [
                    'class' => 'd-block'
                ],
            ])
            ->add('horseShoeSize', IntegerType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'saisir la taille de fer le cas échéant',
                ],
                'label' => 'Taille de fer:',
                'label_attr' => [
                    'class' => 'd-block'
                ],
            ])
            ->add('done', CheckboxType::class, [
                'required' => false,
                'label' => 'Réalisé (oui/non)',
                'label_attr' => [
                    'class' => 'checkbox-switch',
                ],
            ])
            ->add('pathologies', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'saisir les pathologies le cas échéant',
                ],
                'label' => 'Pathologies:',
                'label_attr' => [
                    'class' => 'd-block',
                ],
            ])
            ->add('comments', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'saisir les commentaires le cas échéant',
                ],
                'label' => 'Commentaires:',
                'label_attr' => [
                    'class' => 'd-block',
                ],
            ])
            ->add('horse', EntityType::class, [
                'class' => Horse::class,
                'choice_label' => 'name',
                'label' => 'Cheval:',
                'label_attr' => [
                    'class' => 'd-block',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Intervention::class,
        ]);
    }
}
