<?php

namespace App\Form;

use App\Entity\Customer;
use App\Entity\Adress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class CustomerType extends AbstractType
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
            ->add('phoneNumber', TelType::class, [
                'required'      => false,
                'label' => 'N° téléphone fixe:',
                'label_attr' => [
                    'class' => 'd-block'
                ],
                'attr' => [
                    'placeholder' => 'saisir le numéro de téléphone fixe',
                ]
            ])
            ->add('mobilePhone', TelType::class, [
                'label' => 'N° téléphone mobile:',
                'label_attr' => [
                    'class' => 'd-block'
                ],
                'attr' => [
                    'placeholder' => 'saisir le numéro de téléphone mobile',
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail:',
                'label_attr' => [
                    'class' => 'd-block'
                ],
                'attr' => [
                    'placeholder' => 'saisir le mail',
                ]
            ])
            ->add('adressCustomer', EntityType::class, [
                'class' => Adress::class,
                'label' => 'Adresse',
                'choice_label' => 'firstLine',
                'label_attr' => [
                    'class' => 'd-block'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
