<?php

namespace App\Tests\Entity;

use App\Entity\Adress;
use PHPUnit\Framework\TestCase;

class AdressTest extends TestCase
{
    public function testThereIsLatitude(): void
    {
        $this->assertClassHasAttribute('latitude', Adress::class);
    }
}
