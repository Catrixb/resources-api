<?php

namespace Tests\Unit;

use App\Map;
use PHPUnit\Framework\TestCase;

class MapTest extends TestCase
{
    /** @test */
    public function it_gets_the_map_size()
    {
        $map = new Map(10);

        $this->assertEquals(10, $map->getSize());
    }
}
