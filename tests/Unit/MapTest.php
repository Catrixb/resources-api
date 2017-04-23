<?php

namespace Tests\Unit;

use App\Exceptions\MapException;
use App\Map;
use App\Resource;
use App\Tile;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class MapTest extends TestCase
{
    /** @test */
    public function it_gets_the_map_size()
    {
        $map = new Map(1, $this->createTileCollection(1));

        $this->assertEquals(1, $map->getSize());
    }

    /** @test */
    public function it_gets_the_tiles()
    {
        $tiles = $this->createTileCollection(2 * 2);
        $map = new Map(2, $tiles);

        $this->assertSame($tiles, $map->getTiles());
    }

    /** @test */
    public function the_number_of_tiles_should_match_the_map_size()
    {
        $tiles = $this->createTileCollection(8);

        $this->expectException(MapException::class);

        new Map(10, $tiles);
    }

    /** @test */
    public function it_retrieves_a_tile_by_its_coordinates()
    {
        $tiles = $this->createTileCollection(6 * 6);

        $map = new Map(6, $tiles);

        $this->assertSame($tiles->get(8), $map->getTileByCoordinates(3, 2));
    }

    /** @test */
    public function it_throws_an_exception_if_we_try_to_access_a_non_existing_tile()
    {
        $map = new Map(6, $this->createTileCollection(6 * 6));

        $this->expectException(MapException::class);
        $this->expectExceptionMessage("You're trying to access a non existing tile (8, 7) for a maximum of (6, 6)");

        $map->getTileByCoordinates(8, 7);
    }

    public function it_is_json_serializable()
    {
        $map = new Map(2, $this->createTileCollection(2 * 2));

        $this->assertJsonStringEqualsJsonString(json_encode([
            [['resource' => 1], ['resource' => 1]],
            [['resource' => 1], ['resource' => 1]]
        ]), json_encode($map));
    }

    private function createTileCollection($numberOfTiles): Collection
    {
        $tiles = collect();

        for ($i = 0; $i < $numberOfTiles; ++$i) {
            $tiles->push(new Tile(new Resource(2)));
        }

        return $tiles;
    }
}
