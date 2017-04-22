<?php

namespace Tests\Unit;

use App\Map;
use App\MapGenerator;
use Tests\TestCase;

class MapGeneratorTest extends TestCase
{
    /** @test */
    public function it_generate_a_map_for_a_given_number_of_players()
    {
        $generator = new MapGenerator();
        $map = $generator->generate(3);

        $this->assertInstanceOf(Map::class, $map);
        $this->assertEquals(10, $map->getSize());
    }
}
