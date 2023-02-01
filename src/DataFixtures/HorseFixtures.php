<?php

namespace App\DataFixtures;

use App\Entity\Horse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class HorseFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $samples = [
            [
                'name' => 'Doowie',
                'type' => 'Poney',
                'sexe' => 'Hongre',
                'color' => 'Noir',
            ],
            [
                'name' => 'Irko',
                'type' => 'Poney',
                'sexe' => 'Entier',
                'color' => 'Pie noir',
            ],
            [
                'name' => 'Spirit',
                'type' => 'Poney',
                'sexe' => 'Hongre',
                'color' => 'Dun',
            ],
            [
                'name' => 'Cyrano',
                'type' => 'Cheval de selle',
                'sexe' => 'Hongre',
                'color' => 'Alezan crins lavés',
            ],
            [
                'name' => 'Vivi',
                'type' => 'Poney',
                'sexe' => 'Jument',
                'color' => 'Alezan crins lavés',
            ],
            [
                'name' => 'Ten',
                'type' => 'Cheval de selle',
                'sexe' => 'Jument',
                'color' => 'Blanc',
            ],
            [
                'name' => 'Saphir',
                'type' => 'Cheval de selle',
                'sexe' => 'Hongre',
                'color' => 'Gris',
            ],            
        ];
        $faker = Factory::create();
        foreach ($samples as $key => $sample) {
            $horse = new Horse();
            $horse->setName($sample['name']);
            $horse->setType($sample['type']);
            $horse->setSexe($sample['sexe']);
            $horse->setColor($sample['color']);
            $horse->setOwner($this->getReference('customer_' . $key));
            $horse->setHoster($this->getReference('hoster_' . $key));
            $manager->persist($horse);
            $this->addReference('horse_' . $key, $horse);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
          CustomerFixtures::class,
          HosterFixtures::class,
        ];
    }
}
