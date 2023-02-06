<?php

namespace App\Tests\Service;

use App\Service\Coordinates;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CoordinatesTest extends KernelTestCase
{
     /**
     * @dataProvider cities
     */
    public function testGeocode($coordinatesValue, $cityValues): void
    {
        $kernel = self::bootKernel();

        $coordinates = static::getContainer()->get(Coordinates::class);

        $this->assertSame($coordinatesValue, $coordinates->geocode($cityValues));
    }

    public function cities()
    {
        return [
            [['lat' => '46.1122', 'lon' => '4.87109' ], 'Valeins, France'],
            [['lat' => '46.2165185', 'lon' => '4.943321' ], 'Biziat, France'],
            [['lat' => '46.4339138', 'lon' => '4.6575708' ], 'Cluny, France']
        ];
    }
}
