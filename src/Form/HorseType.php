<?php

namespace App\Form;

use App\Entity\Horse;
use App\Entity\Customer;
use App\Entity\Hoster;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class HorseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('nickname')
            ->add('birthDate', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'attr' => ['class' => 'form-control mt-2 mb-2'],
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Cheval de selle' => 'Cheval de selle',
                    'Cheval de trait' => 'Cheval de trait',
                    'Poney' => 'Poney',
                    'Ane' => 'Ane',
                ]
            ])
            ->add('sexe', ChoiceType::class, [
                'choices' => [
                    'Hongre' => 'Hongre',
                    'Entier' => 'Entier',
                    'Jument' => 'Jument',
                ]
            ])
            ->add('color')
            ->add('sire', TextType::class, [
                'required' => false,
            ])
            ->add('transponder', TextType::class, [
                'required' => false,
            ])
            ->add('duration', IntegerType::class,[
                'label' => 'Nb de semaines entre chaque intervention'
            ])
            ->add('owner', EntityType::class, [
                'class' => Customer::class,
                'choice_label' => 'name',
            ])
            ->add('hoster', EntityType::class, [
                'class' => Hoster::class,
                'choice_label' => 'name',
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Horse::class,
        ]);
    }
}
