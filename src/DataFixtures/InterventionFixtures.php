<?php

namespace App\DataFixtures;

use App\Entity\Intervention;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class InterventionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $samples = [
            [
                'service' => 'parage',
                'deb' => '2023-02-07 11:00:00',
                'fin' => '2023-02-07 12:00:00',
            ],
            [
                'service' => 'parage',
                'deb' => '2023-02-07 10:00:00',
                'fin' => '2023-02-07 11:00:00',
            ],
            [
                'service' => 'parage',
                'deb' => '2023-02-07 09:00:00',
                'fin' => '2023-02-07 10:00:00',
            ],
            [
                'service' => 'parage',
                'deb' => '2023-02-07 14:00:00',
                'fin' => '2023-02-07 15:00:00',
            ],
            [
                'service' => 'parage',
                'deb' => '2023-02-08 10:00:00',
                'fin' => '2023-02-08 11:00:00',
            ],
            [
                'service' => 'ferrage',
                'deb' => '2023-02-08 09:00:00',
                'fin' => '2023-02-08 10:00:00',
            ],
            [
                'service' => 'ferrage',
                'deb' => '2023-02-08 08:00:00',
                'fin' => '2023-02-08 09:00:00',
            ],            
        ];
        $faker = Factory::create();
        foreach ($samples as $key => $sample) {
            $intervention = new Intervention();
            $intervention->setService($sample['service']);
            $intervention->setStartDate($faker->dateTimeBetween('+6 day', '+7 day'));
            $intervention->setDone(0);
            $intervention->setHorse($this->getReference('horse_' . $key));
            $manager->persist($intervention);
            $this->addReference('intervention_' . $key, $intervention);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          HorseFixtures::class,
        ];
    }
}
