<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Provider\fr_FR\PhoneNumber;

class CustomerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $samples = [
            [
                'name' => 'client 1',
            ],
            [
                'name' => 'client 2',
            ],
            [
                'name' => 'client 3',
            ],
            [
                'name' => 'client 4',
            ],
            [
                'name' => 'client 5',
            ],
            [
                'name' => 'client 6',
            ],
            [
                'name' => 'client 7',
            ],            
        ];
        $faker = Factory::create();
        foreach ($samples as $key => $sample) {
            $customer = new Customer();
            $customer->setName($sample['name']);
            $customer->setEmail($faker->email());
            $customer->setMobilePhone($faker->e164PhoneNumber());
            $customer->setAdressCustomer($this->getReference('adress_' . $key));
            $manager->persist($customer);
            $this->addReference('customer_' . $key, $customer);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          AdressFixtures::class,
        ];
    }
}
