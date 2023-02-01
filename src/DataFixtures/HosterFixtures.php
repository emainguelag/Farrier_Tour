<?php

namespace App\DataFixtures;

use App\Entity\Hoster;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class HosterFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $samples = [
            [
                'name' => 'écurie 1',
            ],
            [
                'name' => 'écurie 2',
            ],
            [
                'name' => 'écurie 3',
            ],
            [
                'name' => 'écurie 4',
            ],
            [
                'name' => 'écurie 5',
            ],
            [
                'name' => 'écurie 6',
            ],
            [
                'name' => 'écurie 7',
            ],            
        ];
        foreach ($samples as $key => $sample) {
            $hoster = new Hoster();
            $hoster->setName($sample['name']);
            $hoster->setAdressHoster($this->getReference('adress_' . $key));
            $manager->persist($hoster);
            $this->addReference('hoster_' . $key, $hoster);
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
