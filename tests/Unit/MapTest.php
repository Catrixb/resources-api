<?php

namespace Tests\Unit;

use App\Exceptions\MapException;
use App\Map;
use App\Tile;
use PHPUnit\Framework\TestCase;

class MapTest extends TestCase
{
    /** @test */
    public function it_gets_the_map_size()
    {
        $map = new Map(1, collect([new Tile]));

        $this->assertEquals(1, $map->getSize());
    }

    /** @test */
    public function it_gets_the_tiles()
    {
        $tiles = collect([new Tile, new Tile, new Tile, new Tile]);
        $map = new Map(2, $tiles);

        $this->assertSame($tiles, $map->getTiles());
    }

    /** @test */
    public function the_number_of_tiles_should_match_the_map_size()
    {
        $tiles = collect([new Tile, new Tile, new Tile]);

        $this->expectException(MapException::class);

        new Map(10, $tiles);
    }
}
