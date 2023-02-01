<?php

namespace App\DataFixtures;

use App\Entity\Adress;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AdressFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $samples = [
            [
                'firstLine' => '20 impasse du puits',
                'postalCode' => '01140',
                'city' => 'VALEINS',
            ],
            [
                'firstLine' => 'lieu dit Champtel',
                'postalCode' => '69220',
                'city' => 'DRACE',
            ],
            [
                'firstLine' => '36 impasse des lilas',
                'postalCode' => '01290',
                'city' => 'BIZIAT',
            ],
            [
                'firstLine' => 'quelquepart',
                'postalCode' => '71250',
                'city' => 'CLUNY',
            ],
            [
                'firstLine' => '20 impasse du puits',
                'postalCode' => '01290',
                'city' => 'GRIEGES',
            ],
            [
                'firstLine' => '20 impasse du puits',
                'postalCode' => '01390',
                'city' => 'MONTHIEUX',
            ],
            [
                'firstLine' => '20 impasse du puits',
                'postalCode' => '69480',
                'city' => 'POMMIERS',
            ],            
        ];
        foreach ($samples as $key => $sample) {
            $adress = new Adress();
            $adress->setFirstLine($sample['firstLine']);
            $adress->setPostalCode($sample['postalCode']);
            $adress->setCity($sample['city']);
            $manager->persist($adress);
            $this->addReference('adress_' . $key, $adress);
        }
        $manager->flush();
    }
}
