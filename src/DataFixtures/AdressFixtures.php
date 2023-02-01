<?php

namespace App\DataFixtures;

use App\Entity\Adress;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AdressFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $samples = [
            [
                'firstLine' => '20 impasse du puits',
                'postalCode' => '01140',
                'city' => 'VALEINS',
                'lat' => '46.1122',
                'lon' => '4.87109',
            ],
            [
                'firstLine' => 'lieu dit Champtel',
                'postalCode' => '69220',
                'city' => 'DRACE',
                'lat' => '46.1567878',
                'lon' => '4.7666636',
            ],
            [
                'firstLine' => '36 impasse des lilas',
                'postalCode' => '01290',
                'city' => 'BIZIAT',
                'lat' => '46.2165185',
                'lon' => '4.943321',
            ],
            [
                'firstLine' => '25 rue des Haras Nationaux',
                'postalCode' => '71250',
                'city' => 'CLUNY',
                'lat' => '46.4339138',
                'lon' => '4.6575708',
            ],
            [
                'firstLine' => 'allée de l\'arquebuse',
                'postalCode' => '01290',
                'city' => 'GRIEGES',
                'lat' => '46.2561',
                'lon' => '4.85219',
            ],
            [
                'firstLine' => '18 chemin des alouettes',
                'postalCode' => '01390',
                'city' => 'MONTHIEUX',
                'lat' => '45.9567069',
                'lon' => '4.9410766',
            ],
            [
                'firstLine' => '258 rue de Limas',
                'postalCode' => '69480',
                'city' => 'POMMIERS',
                'lat' => '45.9554834',
                'lon' => '4.6917672',
            ],            
        ];
        foreach ($samples as $key => $sample) {
            $adress = new Adress();
            $adress->setFirstLine($sample['firstLine']);
            $adress->setPostalCode($sample['postalCode']);
            $adress->setLatitude($sample['lat']);
            $adress->setLongitude($sample['lon']);
            $adress->setCity($sample['city']);
            $manager->persist($adress);
            $this->addReference('adress_' . $key, $adress);
        }
        $manager->flush();
    }
}
