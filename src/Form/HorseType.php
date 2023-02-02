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
            ->add('name', TextType::class, [
                'label' => 'Nom:',
                'label_attr' => [
                    'class' => 'd-block'
                ],
                'attr' => [
                    'placeholder' => 'saisir le nom',
                ]
            ])
            ->add('nickname', TextType::class, [
                'label' => 'Surnom:',
                'required'      => false,
                'label_attr' => [
                    'class' => 'd-block'
                ],
                'attr' => [
                    'placeholder' => 'saisir le surnom',
                ]
            ])
            ->add('birthDate', DateType::class, [
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'attr' => ['class' => 'form-control'],
                'label' => 'Date de naissance:',
                'label_attr' => [
                    'class' => 'd-block'
                ],
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Cheval de selle' => 'Cheval de selle',
                    'Cheval de trait' => 'Cheval de trait',
                    'Poney' => 'Poney',
                    'Ane' => 'Ane',
                ],
                'label' => 'Type:',
                'label_attr' => [
                    'class' => 'd-block'
                ],
            ])
            ->add('sexe', ChoiceType::class, [
                'choices' => [
                    'Hongre' => 'Hongre',
                    'Entier' => 'Entier',
                    'Jument' => 'Jument',
                ],
                'label' => 'Sexe:',
                'label_attr' => [
                    'class' => 'd-block'
                ],
            ])
            ->add('color', TextType::class, [
                'label' => 'Robe:',
                'label_attr' => [
                    'class' => 'd-block'
                ],
                'attr' => [
                    'placeholder' => 'saisir la robe',
                ]
            ])
            ->add('sire', TextType::class, [
                'required' => false,
                'label' => 'N° sire:',
                'label_attr' => [
                    'class' => 'd-block'
                ],
                'attr' => [
                    'placeholder' => 'saisir le numéro sire',
                ]
            ])
            ->add('transponder', TextType::class, [
                'required' => false,
                'label' => 'N° de transpondeur:',
                'label_attr' => [
                    'class' => 'd-block'
                ],
                'attr' => [
                    'placeholder' => 'saisir le numéro de transpondeur',
                ]
            ])
            ->add('duration', IntegerType::class,[
                'required' => false,
                'label' => 'Nb de semaines entre chaque intervention:',
                'label_attr' => [
                    'class' => 'd-block'
                ],
                'attr' => [
                    'placeholder' => 'saisir le nombre de semaines entre deux interventions pour alerte',
                ]
            ])
            ->add('owner', EntityType::class, [
                'class' => Customer::class,
                'choice_label' => 'name',
                'label' => 'Propriétaire:',
                'label_attr' => [
                    'class' => 'd-block'
                ],
            ])
            ->add('hoster', EntityType::class, [
                'class' => Hoster::class,
                'choice_label' => 'name',
                'label' => 'Hébergeur:',
                'label_attr' => [
                    'class' => 'd-block'
                ],
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
