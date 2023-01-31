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
                'attr' => ['class' => 'form-control mt-2 mb-2'],
            ])
            ->add('endDate', DateTimeType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'attr' => ['class' => 'form-control mt-2 mb-2'],
            ])
            ->add('service', ChoiceType::class, [
                'choices' => [
                    'Parage' => 'Parage',
                    'Ferrage' => 'Ferrage',
                ]
            ])
            ->add('horseShoeSize', IntegerType::class, [
                'required' => false,
            ])
            ->add('done', CheckboxType::class, [
                'required' => false,
                'label_attr' => [
                    'class' => 'checkbox-switch',
                ],
            ])
            ->add('pathologies', TextareaType::class, [
                'required' => false,
            ])
            ->add('comments', TextareaType::class, [
                'required' => false,
            ])
            ->add('horse', EntityType::class, [
                'class' => Horse::class,
                'choice_label' => 'name',
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
