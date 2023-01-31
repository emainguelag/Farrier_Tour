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
            ->add('name', TextType::class)
            ->add('phoneNumber', TelType::class, [
                'required'      => false,
            ])
            ->add('mobilePhone', TelType::class)
            ->add('email', EmailType::class)
            // ->add('adressCustomer', EntityType::class, [
            //     'class' => Adress::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            //     'expanded' => true,
            //     'by_reference' => false,
            // ])
            ->add('adressCustomer', EntityType::class, [
                'class' => Adress::class,
                'label' => 'Ville',
                'choice_label' => 'city',
            ])
            ->add('adressCustomer', EntityType::class, [
                'class' => Adress::class,
                'label' => 'Adresse',
                'choice_label' => 'firstLine',
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
